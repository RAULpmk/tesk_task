<?php

use \yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Тестовое задание №2';
?>
<h1>Тестовое задание №2</h1>

<!-- Форма для генерации тестовых данных -->
<?php $form = ActiveForm::begin(['id' => 'generate_data', 'action' => 'show']) ?>
<?= Html::hiddenInput('act', 1) ?>
<?= Html::submitButton('Сгенерировать тестовые данные', ['class' => 'btn btn-success btn_marginRight']); ?>
<?= Html::a('Посмотреть данные', '/time/show', ['class' => 'btn btn-primary']); ?>
<?php $form = ActiveForm::end() ?>
