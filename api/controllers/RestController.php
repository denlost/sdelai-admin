<?php
namespace api\controllers;

use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\rest\OptionsAction;
use yii\web\Response;

class RestController extends Controller
{
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
                'except' => [
                    'options',
                ],
            ],
            'corsFilter' => [
                'class' => Cors::class,
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
        return ArrayHelper::merge(parent::actions(), [
            'options' => OptionsAction::className(),
        ]);
    }

    public function beforeAction($action)
    {
        $get = Yii::$app->request->get();
        $post = Yii::$app->request->post();
        Yii::info(['_GET' => $get, '_POST' => $post + $_FILES, 'message' => file_get_contents('php://input'), 'method' => __METHOD__], "api." . __METHOD__);
        return parent::beforeAction($action);
    }

    public function getUser()
    {
        return Yii::$app->getUser()->getIdentity();
    }

    public function afterAction($action, $result)
    {
        $response = print_r(ArrayHelper::toArray($this->serializeData($result)), true);
        Yii::info("RESPONSE ({$action->id}): \n\n". $response ."\n",'request');

        return parent::afterAction($action, $result);
    }
}
