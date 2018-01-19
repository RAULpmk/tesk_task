<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header">
    <div class="container">
        <ul class="nav nav-pills">
            <li role="presentation"<?php if(Yii::$app->request->url=='/'): echo ' class="active"'; endif; ?>><?= Html::a('Главная', '/'); ?></li>
            <li role="presentation"<?php if(strpos(Yii::$app->request->url, '/database/') !== false): echo ' class="active"'; endif; ?>><?= Html::a('База данных', '/database/index'); ?></li>
            <li role="presentation"<?php if(strpos(Yii::$app->request->url, '/currency/') !== false): echo ' class="active"'; endif; ?>><?= Html::a('Тестовое задание №1', '/currency/index'); ?></li>
            <li role="presentation"<?php if(strpos(Yii::$app->request->url, '/time/') !== false): echo ' class="active"'; endif; ?>><?= Html::a('Тестовое задание №2', '/time/index'); ?></li>
        </ul>

    </div>
</header>

<div class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Александр Смирнов <?= date('Y') ?></p>
        <p class="pull-right">Исходный код приложения
            доступен <?= Html::a('по ссылке', 'https://github.com/RAULpmk/tesk_task'); ?>.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
