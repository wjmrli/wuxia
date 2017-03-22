<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn1;
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
        <?= Html::a('增加奖品项', ['add'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'options' => ['style'=>'width:40%'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            ],

            //'ID',
            [
            'attribute'=> '奖品',
            'value'=>'Realname',
            'headerOptions' => ['width' => '50%'],
            ],
            [
            'attribute'=> '每周上限数量',
            'value'=>'Number',
            'headerOptions' => ['width' => '30%'],
            ],
            
            
            
            ['class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{del}',
            'headerOptions' => ['width' => '50'],
            'buttons' => [
            // 下面代码来自于 yii\grid\ActionColumn 简单修改了下
                'del' => function ($url, $model, $key) {
                  $options = [
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    //'data-pjax' => '0',
                    'onclick' => 'del_click(this,"encouragelevel/del")',
                  ];
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', null, $options);
                },
              ],
            ],
        ],
    ]); ?>
</div>
