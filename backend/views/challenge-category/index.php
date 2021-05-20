<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ChallengeCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Challenge Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-category-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create Challenge Category', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'description:ntext',
                'categoryType.name',
                'created_at',
                'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
