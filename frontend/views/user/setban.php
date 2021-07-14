<?php

use yii\widgets\ActiveForm;

?>

<div class="setban-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= \yii\helpers\BaseHtml::errorSummary($setBanForm) ?>

        <?= $form->field($setBanForm, 'amount'); ?>

    <?php ActiveForm::end(); ?>

</div>