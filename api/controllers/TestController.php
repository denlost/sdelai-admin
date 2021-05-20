<?php

namespace api\controllers;

class TestController extends RestController
{
    public function actionTest()
    {
        return ['hello' => 'world'];
    }
}
