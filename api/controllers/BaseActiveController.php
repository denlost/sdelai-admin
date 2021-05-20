<?php

namespace api\controllers;

use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class BaseActiveController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
                'except' => [
                ],
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ]);

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete']);

        return $actions;
    }
}
