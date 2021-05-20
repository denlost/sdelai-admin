<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\components\Utility;

/**
 * This is the model class for table "challenge_post".
 *
 * @property int $id
 * @property int $challenge_id
 * @property int $user_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Challenge $challenge
 * @property User $user
 */
class ChallengePost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['challenge_id', 'user_id', 'content'], 'required'],
            [['challenge_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['challenge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Challenge::className(), 'targetAttribute' => ['challenge_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'challenge_id' => 'Вызов',
            'user_id' => 'Пользователь',
            'content' => 'Сообщение',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallenge()
    {
        return $this->hasOne(Challenge::className(), ['id' => 'challenge_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
