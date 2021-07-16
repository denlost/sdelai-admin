<?php

use yii\widgets\ActiveForm;

?>

<div class="setban-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= \yii\helpers\BaseHtml::errorSummary($setBanForm) ?>

        <?= $form->field($setBanForm, 'bantimesec')->label('Длительность бана (дни)'); ?>

        <?= $form->field($setBanForm, 'bantimehrs')->label('Длительность бана (часы)'); ?>

        <?= $form->field($setBanForm, 'bantimemin')->label('Длительность бана (минуты)'); ?>


    <?php ActiveForm::end(); ?>

</div>