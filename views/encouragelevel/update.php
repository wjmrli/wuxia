<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Encouragelevel */

$this->title = '修改奖项: ';
$this->params['breadcrumbs'][] = ['label' => '奖励设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '查看奖项', 'url' => ['level']];
$this->params['breadcrumbs'][] = ['label' => $model->Markname, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="encouragelevel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gift' => $gift,
    ]) ?>

</div>
