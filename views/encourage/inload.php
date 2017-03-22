<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Encourage */
/* @var $form ActiveForm */
$this->title = "批量录入";
?>

<div class="inload col-lg-10">
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-8">
        <?= $form->field($event, 'Source',[
            'template' => "<div style=\"display:flex\"><div style=\"margin:5px\">{label}</div>&nbsp;&nbsp;{error}</div>{input}", 
        ])->textArea(['rows' => '10']); ?>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
            <label class="control-label" for="record" style="margin: 5px 0 10px 0;">事件日志(点击可查看具体信息)</label>
            <div><pre style="height: 213.6px;" id="record" class='form-control' style="width:100%"><?php foreach($record as $key => $val):
                        $inner = 'title="'.$val->Record.'('.date('m-d H:i',$val->Time).')';
                        $inner .= isset($val->event->Result)?"\n".'执行结果:'."\n".$val->event->Result.'"':'"';
                        echo '<div data-key="'.$key.'" class="record_panel" '.$inner.'><span>'.$val->Record.'('.date('m-d H:i',$val->Time).')</span></div>';
                    endforeach;
                ?>
            </pre></div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-2">
        <?= $form->field($event, 'Blur')->checkBox(['title' => '勾选后将进行类似游戏ID的匹配，除了已激活或已存在于奖励表中的ID，其他都不添加奖励'])?>
        </div>
        <div class="col-lg-1">
        <?= $form->field($event, 'Col')->textInput(['maxlength' => true,])?>
        </div>
        <div class="col-lg-2">
        <?= $form->field($model, 'Gift')->dropDownList($gift)->label('奖品或操作') ?>
        </div>
        <div class="col-lg-1">
        <?= $form->field($model, 'Number')->textInput(['maxlength'=>true,'value'=>1])->label('数量')?>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-3">
        <?= $form->field($model, 'Record')->textInput(['maxlength' => true])?>
        </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- inload -->
<script>
$(document).ready(function(){
        $('#record').height($('#event-source').height());
});
</script>

