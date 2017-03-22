<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gift */

$this->title = '增加奖品项';
$this->params['breadcrumbs'][] = ['label' => '奖励设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '查看奖品', 'url' => ['gift']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gift-add">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="gift-form">
    
        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'Realname')->textInput(['maxlength' => true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>

</div>
