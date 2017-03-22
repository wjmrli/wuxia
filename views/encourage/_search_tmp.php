<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TmpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UID') ?>

    <?= $form->field($model, 'Player') ?>

    <?= $form->field($model, 'EID') ?>

    <?= $form->field($model, 'Awards') ?>

    <?= $form->field($model, '金子') ?>

    <?php // echo $form->field($model, '金子ed') ?>

    <?php // echo $form->field($model, '金箱子') ?>

    <?php // echo $form->field($model, '金箱子ed') ?>

    <?php // echo $form->field($model, '资源箱子') ?>

    <?php // echo $form->field($model, '资源箱子ed') ?>

    <?php // echo $form->field($model, 'Here') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
