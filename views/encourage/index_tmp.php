<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TmpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看结果';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
</script>
<div class="tmp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <p>
            <?php
            if(!empty($chooses))
             foreach($chooses as $val):
                    echo "<div class=\"col-lg-1\">".Html::a($val, ['index','choose' => $val], ['class' => 'btn btn-default'])."</div>";
                    endforeach;?>
        </p>
    </div>
    <?php $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            'userdata.Player',
            'Awards',
        ];
        if(isset($_SESSION['choose'])){
            $columns = array_merge($columns,
            [
                [
                    'label' => '未发'.$_SESSION['choose'],
                    'attribute' => $_SESSION['choose'],
                    'value' => $_SESSION['choose'],
                ],
                [
                    'label' => '建议发'.$_SESSION['choose'],
                    'attribute'=>$_SESSION['choose'], 
                    'value' => function($model){
                        eval("\$done = \$model->".$_SESSION['choose']."ed;");
                        eval("\$gift = \$model->".$_SESSION['choose'].";");
                        if($_SESSION['limit'] - $done - $gift> 0){
                            return ($gift);
                        }else return ($_SESSION['limit'] - $done); 
                    }
                ],
            ]);
            //$dataProvider->query->select([$chose,'Player','Awards',$_SESSION['choose'],'UID','Here']);
        }
        $columns = array_merge($columns,[
        ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                  if(isset($_SESSION['choose'])){
                  $options = [
                    'title' => '完成',
                    'aria-label' => '完成',
                    'onclick' => 'del_click(this,"encourage/done")',
                  ];
                  return Html::a('<span class="glyphicon glyphicon-pencil"></span>', NULL, $options);
                  }
                },
                'delete' => function ($url, $model, $key) {
                  if(isset($_SESSION['choose'])){
                  $options = [
                    'title' => '注销',
                    'aria-label' => '注销',
                    //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    //'data-method' => 'post',
                    //'data-pjax' => '0',
                    'onclick' => 'del_click(this,"encourage/del")',
                  ];
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', NULL, $options);
                  }
                },
              ],
        ]]);
        ?>
    <?php Pjax::begin(); 
    
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style'=>'width:70%;'],
        'rowOptions'=>function($model,$key,$index,$grid) {
            if(isset($_SESSION['limit'])&&isset($_SESSION['choose']))
            {
                eval("\$done = \$model->".$_SESSION['choose']."ed;");
                
                if($_SESSION['limit'] <= $done){
                    $color = 'background-color:#ff9999';
                }
            }
            if(!isset($color)){
                if($model->userdata->attributes['Here']==0) $color = 'background-color:#ccffff';
                else $color = 'background-color:#ffffcc';
            }
            return ['style' => $color,]; },
        //'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?><?php Pjax::end(); ?>
</div>
