<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_reason".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 *
 * @property Report[] $reports
 * @property UserBan[] $userBans
 */
class ReportReason extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_reason';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['reason_id' => 'id']);
    }

    /**
     * Gets query for [[UserBans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserBans()
    {
        return $this->hasMany(UserBan::className(), ['reason_id' => 'id']);
    }
}
