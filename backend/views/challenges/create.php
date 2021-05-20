<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Challenge */

$this->title = Yii::t('app', 'Create Challenge');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Challenges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
