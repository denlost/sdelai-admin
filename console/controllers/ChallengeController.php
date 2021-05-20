<?php
namespace console\controllers;

use common\models\BlockUnit;
use yii\console\Controller;

class ChallengeController extends Controller
{
    public function actionCreateBlockUnit($name)
    {
        if (BlockUnit::findOne(['name' => $name])) {
            echo "Unit {$name} already exists" . PHP_EOL;
            return false;
        }

        $blockUnit = new BlockUnit([
            'name' => $name,
            'deleted' => 0
        ]);

        if (!$blockUnit->save()) {
            throw new \Exception('ERROR ADDING BLOCK UNIT');
        }

        echo "New unit: {$blockUnit->name} added" . PHP_EOL;
    }
}