<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EncouragelevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看奖项';
$this->params['breadcrumbs'][] = ['label' => '奖励设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$a = ['class' => 'btn btn-success' ];
if(isset($createable)){
    $a['onclick'] = 'alert("需要先设置奖品，再添加奖项")';
}

?>
<div class="encouragelevel-level">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加奖项', [isset($createable)?'add':'create'], $a) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'width:60%'],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            'Markname',
            'Realname',
            'Number',

            ['class' => 'yii\grid\ActionColumn',
            'buttons'=>[
                'delete'=> function ($url, $model, $key) {
                  $options = [
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    //'data-pjax' => '0',
                    'onclick' => 'del_click(this,"encouragelevel/delete")',
                  ];
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', null, $options);
                },
            ]
            ],
        ],
    ]); ?>
</div>
