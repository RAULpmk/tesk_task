<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

$this->title = 'Тестовое задание №1';
?>
<h1>Тестовое задание №1</h1>

<p>Источник данных: <?= Html::a('ссылка', 'http://www.cbr.ru/scripts/XML_daily.asp'); ?>.</p>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <!-- Флеш-сообщение с результами загрузки ссылки -->
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <!-- Флеш-сообщение с результами загрузки ссылки -->
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif; ?>

<!-- Отображение данных в таблице при помощи виджета пагинации (работающего на основе ajax-запросов) -->
<?php Pjax::begin(); ?>
<table class="table">
    <tr>
        <th>Цифровой код</th>
        <th>Буквенный код</th>
        <th>Единиц</th>
        <th>Валюта</th>
        <th>Курс</th>
    </tr>
    <?php foreach ($currency as $item => $value): ?>
        <tr>
            <td><?= $value['num_code']; ?></td>
            <td><?= $value['char_code']; ?></td>
            <td><?= $value['nominal']; ?></td>
            <td><?= $value['name']; ?></td>
            <td><?= $value['value']; ?></td>
        </tr>
    <? endforeach; ?>
</table>
<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>
<?php Pjax::end(); ?>

<?= Html::a('Назад', '/currency/index', ['class' => 'btn btn-primary']); ?>
