<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ChallengeCategory */

$this->title = 'Create Challenge Category';
$this->params['breadcrumbs'][] = ['label' => 'Challenge Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-category-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
