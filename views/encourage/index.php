<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EncourageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Encourages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encourage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <!--<?= Html::a('Create Encourage', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>
    <?= Block::begin([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            'UID',
            'EID',
            'Time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= Block::end(); ?>
</div>
