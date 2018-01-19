<?php

use yii\widgets\ActiveForm;

?>

    <div class="post-search">
        <?php $form = ActiveForm::begin(['method' => 'get', 'id' => 'filter_form',
            'options' => [
                'enctype' => 'json',
                'data-pjax' => true,
            ]]
        ); ?>

        <?= $form->field($searchModel, 'limit')->label(false)->hiddenInput(['id' => 'limit', 'value' => $dataProvider->getPagination()->pageSize]); ?>
        <?= $form->field($searchModel, 'fullName')->textInput(['id' => 'fullName']); ?>
        <?= $form->field($searchModel, 'factTimeFrom')->textInput(['id' => 'factTimeFrom']); ?>
        <?= $form->field($searchModel, 'factTimeTo')->textInput(['id' => 'factTimeTo']); ?>

        <?php ActiveForm::end(); ?>
    </div>

<?php
$script = <<< JS
    $('#filter_form').on('beforeSubmit', function(){
        var data =  $(this).serialize();
        $.pjax.reload({container:"#time_grid", data: data, url: $(this).attr('action'), timeout: 3000});
        return false;
    });

    $(document).on('keyup', '#fullName', function(e) {
        $('#limit').val(10);
        $('#filter_form').submit();
    });
    
    $(document).on('keyup', '#factTimeFrom', function(e) {
        $('#limit').val(10);
        $('#filter_form').submit();
    });
    
    $(document).on('keyup', '#factTimeTo', function(e) {
        $('#limit').val(10);
        $('#filter_form').submit();
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>