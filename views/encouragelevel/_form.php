<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Encouragelevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encouragelevel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Markname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Realname')->dropDownList($gift) ?>
    
    <?= $form->field($model, 'Number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
