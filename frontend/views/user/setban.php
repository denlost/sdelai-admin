<?php

use yii\widgets\ActiveForm;

?>

<div class="setban-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($setBanForm, 'days'); ?>
        <?= $form->field($setBanForm, 'hours'); ?>
        <?= $form->field($setBanForm, 'minutes'); ?>
        <?= $form->field($setBanForm, 'reason_code'); ?>

    <?php ActiveForm::end(); ?>

</div>