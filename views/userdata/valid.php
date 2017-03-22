<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '激活审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
<?php Pjax::begin(); ?>
    <?= Gridview::widget([
        'dataProvider' => $dataProvider,
        'options'=>['style'=>'width:50%'],
        //'filterModel' => $searchModel,
        'columns' => [
            [
            'class' => 'yii\grid\SerialColumn',
            ],

            //'ID',
            'Time:date',
            'Player',
            //'Here',

            ['class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{update}{del}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                  $options = [
                    'title' => '注册',
                    'aria-label' => '注册',
                    'onclick' => 'del_click(this,"userdata/update")',
                  ];
                  return Html::a('<span class="glyphicon glyphicon-pencil"></span>', null, $options);
                },
                'del' => function ($url, $model, $key) {
                  $options = [
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'onclick' => 'del_click(this,"userdata/del")',
                  ];
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', null, $options);
                },
              ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
