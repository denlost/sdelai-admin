<?php

use common\models\User;
use common\models\UserBan;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
        'attribute' => 'username',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Никнейм...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'first_name',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'first_name'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Имя пользователя...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'last_name',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'last_name'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Фамилия пользователя...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'email',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'email'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Статус пользователя...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'phone',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'phone'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Статус пользователя...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'status'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Статус пользователя...'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'banned',
        'value' => function ($model) {
            return UserBan::banned($model) ? "Забанен" : "Активный";
        },
        'label' => 'Статус',
        'filterType' => GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions' => [
            'dataset' => [[
                'local' => ArrayHelper::map(User::find()->all(), 'id', 'status'),
                'limit' => 10,
            ]]
        ],
        'filterInputOptions' => ['placeholder' => 'Статус пользователя...'],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Бан пользователя',
        'template' => '{setban}',
        'buttons' => [
            'setban' => function ($url, $model) {
                $btnClass = 'btn-success';
                $btnText = 'Забанить';

                // TODO: Check for actual ban entry
                if (UserBan::banned($model)) {
                    $btnClass = 'disabled';
                    $btnText = 'Забанен';
                }
                
                return Html::a($btnText, $url, [
                    'setban',
                    'class' => 'btn btn-sm ' . $btnClass,
                    'data-pjax' => "0",
                    'role' => "modal-remote",
                    'data-request-method' => "get",
                    'data-toggle' => "tooltip",
                ]);
        
            },
        ],
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action,'id'=>$key]);
        },
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
