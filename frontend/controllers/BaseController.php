<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller
{
    function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}