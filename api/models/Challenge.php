<?php

namespace api\models;

use Yii;

class Challenge extends \common\models\Challenge
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = [
            'name', 'category_id', 'description', 'category', 'duration', 'max_members', 'price', 'start_date'
        ];

        $scenarios[self::SCENARIO_UPDATE] = [
            'name', 'category_id', 'description', 'category', 'duration', 'max_members', 'price', 'start_date'
        ];

        return $scenarios;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->prepareCreate();
        }

        return true;
    }

    private function prepareCreate(): void
    {
        $this->creator_id = Yii::$app->user->id;
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'creator' => function($model) {
                return $model->creator->email;
            },
            'description',
            'category' => function($model) {
                return $model->category->name;
            },
            'created_at',
            'duration',
            'max_members',
            'price',
            'start_date',
        ];
    }
}