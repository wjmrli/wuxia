<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Encouragelevel */

$this->title = '查看奖项';
$this->params['breadcrumbs'][] = ['label' => '奖励设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '查看奖项', 'url' => ['level']];
$this->params['breadcrumbs'][] = $model->Markname;
?>
<div class="encouragelevel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更改', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除该项?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID',
            'Markname',
            'Realname',
            'Number',
        ],
    ]) ?>

</div>
