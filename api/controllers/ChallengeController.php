<?php

namespace api\controllers;

use api\models\Challenge;
use api\models\search\ChallengeSearch;
use common\models\ChallengeMember;
use Yii;
use yii\web\NotFoundHttpException;

class ChallengeController extends BaseActiveController
{
    public $modelClass = Challenge::class;
    public $createScenario = Challenge::SCENARIO_CREATE;
    public $updateScenario = Challenge::SCENARIO_UPDATE;

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'update' || $action === 'delete') {
            if ($model->creator_id !== Yii::$app->user->id)
                throw new \yii\web\ForbiddenHttpException('Попытка изменить чужой вызов!');
        }
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new ChallengeSearch;
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    public function actionJoin($id)
    {
        $challenge = $this->getChallenge($id);

        return $challenge->memberJoin(Yii::$app->user->getIdentity());
    }

    public function actionLeave($id)
    {
        $challenge = $this->getChallenge($id);

        return $challenge->memberLeave(Yii::$app->user->getIdentity());
    }

    public function actionMembers($id)
    {
        return ChallengeMember::find()
            ->alias('cm')
            ->joinWith([
                'user as u' => function ($query) {
                    $query->select('id, email');
                }
            ], false, 'INNER JOIN')
            ->select(['id' => 'u.id', 'email' => 'u.email'])
            ->where(['cm.challenge_id' => $id])
            ->asArray()
            ->all();
    }

    private function getChallenge($id): Challenge
    {
        $challenge = Challenge::findOne($id);
        if (!$challenge) {
            throw new NotFoundHttpException(Yii::t('app', 'Challenge not found'));
        }

        return $challenge;
    }
}