<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\Utility;

/**
 * This is the model class for table "challenge_member".
 *
 * @property int $id
 * @property int $user_id
 * @property int $challenge_id
 * @property string $created_at
 * @property string $updated_at
 */
class ChallengeMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'challenge_id'], 'required'],
            [['user_id', 'challenge_id'], 'integer'],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['user_id', 'challenge_id'], 'unique', 'targetAttribute' => ['user_id', 'challenge_id']],
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
            'user_id' => 'Пользователь',
            'challenge_id' => 'Вызов',
            'created_at' => 'Присоединился',
            'updated_at' => 'Обновлен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallenge()
    {
        return $this->hasOne(Challenge::class, ['id' => 'challenge_id']);
    }
}
