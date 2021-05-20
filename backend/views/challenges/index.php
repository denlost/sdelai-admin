<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ChallengeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Challenges');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Challenge'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'creator.username',
                'created_at',
                // 'updated_at',
                // 'category_id',
                // 'duration',
                // 'max_members',
                // 'price',
                // 'start_date',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
