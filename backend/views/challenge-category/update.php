<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ChallengeCategory */

$this->title = 'Update Challenge Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Challenge Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="challenge-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
