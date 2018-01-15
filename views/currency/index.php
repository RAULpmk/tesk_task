<?php

use \yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Тестовое задание №1';
?>
<h1>Тестовое задание №1</h1>

<!-- Форма для запроса данных по ссылке -->
<?php $form = ActiveForm::begin(['id' => 'load_xml', 'action' => 'show']) ?>
<?= Html::hiddenInput('act', 1) ?>
<?= Html::submitButton('Получить данные', ['class' => 'btn btn-success btn_marginRight']); ?>
<?= Html::a('Посмотреть загруженные данные', '/currency/show', ['class' => 'btn btn-primary']); ?>
<?php $form = ActiveForm::end() ?>
