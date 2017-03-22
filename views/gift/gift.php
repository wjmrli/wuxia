<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GiftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看奖品';
$this->params['breadcrumbs'][] = ['label' => '奖励设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gift-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gift', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Realname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
