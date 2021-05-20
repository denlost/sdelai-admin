<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\components\Utility;

class PeriodType extends ActiveRecord
{
    public static function tableName()
    {
        return 'period_type';
    }

    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name', 'code'], 'string'],
            [['created_at', 'updated_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
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

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'code' => 'Код',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

}
