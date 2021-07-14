<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_ban".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $executor_id
 * @property int|null $reason_id
 * @property string|null $date_start
 * @property string|null $date_end
 *
 * @property ReportReason $reason
 * @property User $user
 * @property User $executor
 */
class UserBan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_ban';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'executor_id', 'reason_id'], 'default', 'value' => null],
            [['user_id', 'executor_id', 'reason_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['reason_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportReason::className(), 'targetAttribute' => ['reason_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'executor_id' => 'ID Забанившего',
            'reason_id' => 'Причина',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
        ];
    }

    /**
     * Gets query for [[Reason]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReason()
    {
        return $this->hasOne(ReportReason::className(), ['id' => 'reason_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }
}
