<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Challenge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="challenge-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'creator_id')->dropDownList(
                ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username')
        ) ?>

        <?= $form->field($model, 'category_id')->dropDownList(
                ArrayHelper::map(\common\models\ChallengeCategory::find()->asArray()->all(), 'id', 'name')
        ) ?>

        <?= $form->field($model, 'duration')->textInput()->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'max_members')->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'start_date')->widget(DatePicker::class, [
                'convertFormat' => true,
                'options' => ['placeholder' => 'Enter event time ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-MM-d',
                    'autoclose' => true
                ]
            ]);
        ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
