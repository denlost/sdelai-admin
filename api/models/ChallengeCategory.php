<?php

namespace api\models;

class ChallengeCategory extends \common\models\ChallengeCategory
{
    public function fields()
    {
        return [
            'id',
            'name',
            'description',
            'category_type' => function($model) {
                return $model->categoryType->name;
            },
        ];
    }
}