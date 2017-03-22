<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bangpai */

$this->title = 'Create Bangpai';
$this->params['breadcrumbs'][] = ['label' => 'Bangpais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bangpai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
