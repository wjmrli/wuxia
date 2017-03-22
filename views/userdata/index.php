<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看历史';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            'Time:date',
            'Player',
            //'Here',
            
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
