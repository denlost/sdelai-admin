<?php

namespace api\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use api\models\forms\LoginForm;
use api\models\forms\RegisterForm;
use yii\web\ServerErrorHttpException;
use common\models\Auth;

class AuthController extends RestController
{
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
                'except' => [
                    'login',
                    'register',
                ],
            ],
        ]);

        return $behaviors;
    }

    public function actionRegister()
    {
        $model = new RegisterForm;
        $model->load(Yii::$app->request->bodyParams, '');
        if ($auth = $model->register()) {
            return true;
        }

        if ($model->hasErrors() === false) {
            throw new ServerErrorHttpException('Failed for unknown reason.');
        }

        return $model;
    }

    public function actionLogin()
    {
        $model = new LoginForm;
        $model->load(Yii::$app->request->bodyParams, '');
        if ($auth = $model->login()) {
            return [
                'user' => [
                    'auth_token' => $auth['auth_token'],
                    'expires_at' => time() + Yii::$app->params['authTokenExpire'],
                ]
            ];
        }

        if ($model->hasErrors() === false) {
            throw new ServerErrorHttpException('Failed for unknown reason.');
        }

        return $model;
    }

    public function actionLogout()
    {
        $auth = Auth::findOne(['user_id' => Yii::$app->user->id]);
        if ($auth) {
            $auth->delete();
        }

        return Yii::$app->user->logout();
    }
}