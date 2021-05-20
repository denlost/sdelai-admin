<?php

namespace api\controllers;

use api\models\ChallengeCategory;

class ChallengeCategoryController extends BaseActiveController
{
    public $modelClass = ChallengeCategory::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create'], $actions['update']);

        return $actions;
    }
}