<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Userdata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userdata-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3">
    <?= $form->field($model, 'Player',[
        'template' => '{label}{input}</br>'.Html::submitButton('激活' ,['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']).'{error}',
        ])->textInput(['maxlength' => true]) ?>
    </div>
    <?php if(!empty($msg)){
        echo '<div class=col-lg-3><span>'.$msg.'</span></div>';
    }?>
    <?php ActiveForm::end(); ?>

</div>
