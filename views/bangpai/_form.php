<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bangpai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bangpai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Daqv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fuwuqi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Pay_Time')->textInput() ?>

    <?= $form->field($model, 'Game_ID')->textInput() ?>

    <?= $form->field($model, 'Active_Time')->textInput() ?>

    <?= $form->field($model, 'Function')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Balance')->textInput() ?>

    <div><input type="checkbox" value="1" /><a href="/index.php?r=site/principle">天刀帮管使用协议</a></div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
