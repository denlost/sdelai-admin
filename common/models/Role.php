<?php

namespace common\models;

use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_USER = 'user';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name', 'code'], 'string'],
            [['name'], 'unique'],
            [['code'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'code' => 'Код',
        ];
    }

    public static function getRoleByCode(string $roleCode): ?Role
    {
        return self::find()->where(['code' => $roleCode])->one();
    }
}