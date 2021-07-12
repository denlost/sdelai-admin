<?php

use yii\widgets\DetailView;

?>

<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'first_name',
            'last_name',
            'email',
            'phone',
            'status',
        ],
    ]) ?>

</div>