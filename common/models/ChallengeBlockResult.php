<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "challenge_block_result".
 *
 * @property int $id
 * @property int $challenge_block_id
 * @property int $user_id
 * @property int $repetitions
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ChallengeBlock $challengeBlock
 * @property User $user
 */
class ChallengeBlockResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge_block_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['challenge_block_id', 'user_id'], 'required'],
            [['challenge_block_id', 'user_id', 'repetitions'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['challenge_block_id', 'user_id'], 'unique', 'targetAttribute' => ['challenge_block_id', 'user_id']],
            [['challenge_block_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChallengeBlock::className(), 'targetAttribute' => ['challenge_block_id' => 'id']],
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
            'challenge_block_id' => 'Блок',
            'user_id' => 'Пользователь',
            'repetitions' => 'Повторений сделано',
            'comment' => 'Комментарий',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallengeBlock()
    {
        return $this->hasOne(ChallengeBlock::className(), ['id' => 'challenge_block_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
