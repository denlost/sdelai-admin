<?php

use common\models\User;
use common\models\UserBan;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(UserBan::find()->all(), 'id', 'user_id'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'ID пользователя...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'executor_id',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(UserBan::find()->all(), 'id', 'executor_id'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'ID забанившего...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'reason_id',
        'value' => function ($model) {
            return $model->reason->code;
        },
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(UserBan::find()->all(), 'id', 'reason_id'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Причина...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'date_start',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(UserBan::find()->all(), 'id', 'date_start'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Дата начала...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'date_end',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(UserBan::find()->all(), 'id', 'date_end'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Дата окончания...'],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update} {delete}',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false,
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Вы уверены?',
            'data-confirm-message' => 'Вы уверены, что хотите удалить эту строку?'
        ],
    ],
];
