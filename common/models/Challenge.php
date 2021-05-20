<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\Utility;

/**
 * This is the model class for table "challenge".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $category_id
 * @property int $duration
 * @property int $max_members
 * @property string $price
 * @property string $start_date
 * @property int $period_type_id
 *
 * @property ChallengeCategory $category
 * @property User $creator
 * @property PeriodType $period_type
 */
class Challenge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'creator_id', 'category_id', 'description'], 'required'],
            [['description'], 'string'],
            [['creator_id', 'category_id', 'period_type_id'], 'integer'],
            [['duration', 'max_members'], 'integer', 'min' => 1],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['start_date', 'end_date'], 'datetime', 'format' => 'php:Y-m-d'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChallengeCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['period_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PeriodType::class, 'targetAttribute' => ['period_type_id' => 'id']],

        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => Utility::getDateNow(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'creator_id' => Yii::t('app', 'Creator'),
            'created_at' => Yii::t('app', 'Creation date'),
            'updated_at' => Yii::t('app', 'Changed'),
            'category_id' => Yii::t('app', 'Category'),
            'period_type_id' => Yii::t('app', 'PeriodType'),
            'duration' => Yii::t('app', 'Days'),
            'max_members' => Yii::t('app', 'Maximum number of participants'),
            'price' => Yii::t('app', 'Price'),
            'start_date' => Yii::t('app', 'Beginning date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ChallengeCategory::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    public function getPeriodType()
    {
        return $this->hasOne(PeriodType::class, ['id' => 'period_type_id']);
    }

    public function memberJoin(User $user): bool
    {
        if (!$user) {
            return false;
        }

        if (ChallengeMember::find()->where(['user_id' => $user->id, 'challenge_id' => $this->id])->exists()) {
            return true;
        }

        $challengeMember = new ChallengeMember;
        $challengeMember->user_id = $user->id;
        $challengeMember->challenge_id = $this->id;
        if (!$challengeMember->save()) {
            throw new \Exception($challengeMember->getFirstError($this->name));
        }

        return true;
    }

    public function memberLeave(User $user): bool
    {
        if (!$user) {
            return false;
        }

        $member = ChallengeMember::find()->where(['user_id' => $user->id, 'challenge_id' => $this->id])->one();

        if (!$member) {
            return true;
        }

        return boolval($member->delete());
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $this->memberJoin(Yii::$app->user->getIdentity());
        }
    }
}
