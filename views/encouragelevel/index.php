<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Encouragelevel */

$this->title = '奖励设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encouragelevel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('设置奖品', ['gift'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('设置奖项', ['level'], ['class' => 'btn btn-success']) ?>

</div>
