<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;

$this->title = 'Тестовое задание №2';
?>
<h1>Тестовое задание №2</h1>

<?php /*Pjax::begin(['id' => 'time_diagram']); */?><!--
<?php /*echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Диаграма времени тренеров'],
        'xAxis' => [
            'categories' => $arr_coaches
        ],
        'yAxis' => [
            'formatter' => function () {
                var seconds = (this.value / 1000) | 0;
                this.value -= seconds * 1000;

                var minutes = (seconds / 60) | 0;
                seconds -= minutes * 60;

                var hours = (minutes / 60) | 0;
                minutes -= hours * 60;
                return hours;
            }
        ],
        'series' => [
            ['type' => 'column', 'name' => 'Запланированное время', 'data' => $arr_times['plan_time']],
            ['type' => 'column', 'name' => 'Фактическое время', 'data' => $arr_times['fact_time']],
            ['type' => 'column', 'name' => 'Внеурочное время', 'data' => $arr_times['over_time']]
        ]
    ]
]);
*/?>
--><?php /*Pjax::end(); */?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <!-- Флеш-сообщение с результами генерации данных -->
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?= $this->render('_search', compact('searchModel', 'dataProvider')); ?>
<?php Pjax::begin(['id' => 'time_grid']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{summary}\n{items}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'fullName' => [
            'attribute' => 'fullName',
            'value' => function ($data) {
                return $data->getFullName();
            }],
        'plan_time',
        'fact_time',
        'over_time'
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
        'id' => 'grid_table'
    ],
]);
?>
<?php Pjax::end(); ?>

<?= Html::a('Назад', '/time/index', ['class' => 'btn btn-primary']); ?>

<?php
$script = <<< JS
    var max_records = $numActiveRecords;
    var can_ajax = true;
    var lastRecordNum = 0;
    $(window).scroll(function () {
        var winScrollTop = $(this).scrollTop();
        var lastRecord = $('#grid_table tr:last');
        if ($(window).height() + winScrollTop >= lastRecord.offset().top + lastRecord.height() && can_ajax) {
            lastRecordNum = parseInt($('#limit').val()) + 10;
            if (lastRecordNum > max_records) {
                lastRecordNum = max_records;
            }
            $('#limit').val(lastRecordNum);
            can_ajax = false;
            $('#filter_form').submit();
        }        
    });
    
    $('#time_grid').on('pjax:end', function() {
        if ($('#limit').val() < max_records) {
            can_ajax = true;                    
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
