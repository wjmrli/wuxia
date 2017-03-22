<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bangpai */

$this->title = 'Update Bangpai: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Bangpais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bangpai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
