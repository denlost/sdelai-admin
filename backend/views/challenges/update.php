<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Challenge */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Challenge',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Challenges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="challenge-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
