<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Bangpai */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
        function fuwuqi(i){
            var allfuwuqi = <?php echo json_encode($fuwuqi)?>;
            if($('#bangpai-fuwuqi').find('option').length==1||i==1)
            $('#bangpai-fuwuqi').html(allfuwuqi[$('#bangpai-daqv').val()]);
        }
        $(document).ready(function(){
            fuwuqi();
        })
    </script>
<div class="bangpai-form">
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => $model->isNewRecord ?"<div class=\"col-lg-1\">{label}</div><div class=\"col-lg-2\">{input}</div><div class=\"col-lg-2\">{error}</div></br>":
                                                "<div class=\"col-lg-2\">{label}</div><div class=\"col-lg-3\">{input}</div><div class=\"col-lg-3\">{error}</div></br>",
        ],
        'options' => ['onsubmit' => 'bangpaisubmit()'],
    ]); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Daqv')->dropDownList($daqv,[
        'onchange' => 'fuwuqi(1)',
    ]) ?>

    <?= $form->field($model, 'Fuwuqi')->dropDownList(['请选择'],[
        'onmouseover' => 'fuwuqi()',
    ]) ?>

    <?= $form->field($model, 'Game_ID')->textInput() ?>

    <?=$model->isNewRecord ?'<div class="form-group"><input type="checkbox" onclick="aprin(this)"/>同意<a href="/index.php?r=site/principle">天刀帮管使用协议</a></div>':null?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创 建' : '修 改', ['class' => $model->isNewRecord ?'btn btn-success':'btn btn-primary', 'style'=>$model->isNewRecord ?'display:none':null]) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
