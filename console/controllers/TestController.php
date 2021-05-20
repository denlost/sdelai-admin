<?php

namespace console\controllers;

use common\components\Utility;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionTime()
    {
        echo Utility::getDateNow() . PHP_EOL;
    }
}