<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script>
        function fuwuqi(i){
            var allfuwuqi = <?php echo json_encode($fuwuqi)?>;
            if($('#bangpai-fuwuqi').find('option').length==1||i==1)
            $('#bangpai-fuwuqi').html(allfuwuqi[$('#bangpai-daqv').val()]);
        }
</script>
<div class="bangpai-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-1\">{label}</div><div class=\"col-lg-3\">{input}</div><div class=\"col-lg-6\">{error}</div></br>",
        ],
        'options' => ['onsubmit' => 'bangpaisubmit()'],
    ]); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->daqv, 'Daqv')->dropDownList($daqv,[
        'onchange' => 'fuwuqi(1)',
    ]) ?>

    <?= $form->field($model->fuwuqi, 'Fuwuqi')->dropDownList(['��ѡ��'],[
        'onmouseover' => 'fuwuqi()',
    ]) ?>

    <?= $form->field($model, 'Game_ID')->textInput() ?>

    <div class="form-group"><input type="checkbox" onclick="aprin(this)"/>ͬ��<a href="/index.php?r=site/principle">�쵶���ʹ��Э��</a></div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '����' : 'Update', ['class' => 'btn btn-success', $model->isNewRecord ?'style'=>'display:none':null]) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>