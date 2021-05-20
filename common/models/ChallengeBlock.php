<?php

namespace common\models;

use common\components\Utility;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "challenge_block".
 *
 * @property int $id
 * @property string $name
 * @property int $unit_id
 * @property int $repetitions
 * @property string $comment
 * @property int $order
 * @property int $day_number
 * @property int $challenge_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Challenge $challenge
 * @property BlockUnit $unit
 * @property ChallengeBlockResult[] $challengeBlockResults
 * @property User[] $users
 */
class ChallengeBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'unit_id', 'repetitions', 'order', 'period_number', 'challenge_id'], 'required'],
            [['unit_id', 'repetitions', 'order', 'day_number', 'challenge_id'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['name'], 'string', 'max' => 255],
            [['challenge_id', 'day_number', 'order'], 'unique', 'targetAttribute' => ['challenge_id', 'day_number', 'order']],
            [['challenge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Challenge::class, 'targetAttribute' => ['challenge_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlockUnit::class, 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'name'),
            'unit_id' => 'Единица измерения',
            'repetitions' => 'Повторений',
            'comment' => 'Комментарий',
            'order' => 'Очередность',
            'day_number' => 'День',
            'challenge_id' => 'Вызов',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
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
     * @return \yii\db\ActiveQuery
     */
    public function getChallenge()
    {
        return $this->hasOne(Challenge::class, ['id' => 'challenge_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(BlockUnit::class, ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallengeBlockResults()
    {
        return $this->hasMany(ChallengeBlockResult::class, ['challenge_block_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('challenge_block_result', ['challenge_block_id' => 'id']);
    }
}
