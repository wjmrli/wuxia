<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bangpais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bangpai-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bangpai', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Name',
            'Daqv',
            'Fuwuqi',
            'Pay_Time:datetime',
            // 'Game_ID',
            // 'Active_Time:datetime',
            // 'Function',
            // 'Balance',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
