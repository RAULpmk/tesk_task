<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="post-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'creation_date') ?>

    <?php ActiveForm::end(); ?>
</div>