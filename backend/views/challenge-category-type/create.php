<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ChallengeCategoryType */

$this->title = 'Create Challenge Category Type';
$this->params['breadcrumbs'][] = ['label' => 'Challenge Category Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-category-type-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
