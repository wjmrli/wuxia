<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BangpaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的帮派';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bangpai-index">

    <div class="col-lg-12">
        <div></div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建帮派', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="body-content">

        <div class="col-lg-10">
            <?php if(isset($dataProvider)) echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_post',
            ]); ?>
                
        </div>

    </div>
</div>
<script>
$(document).ready(function(){
    $('.wrap').css('background','url(http://ossweb-img.qq.com/images/wuxia/act/a20160626ydy/bg20160626.jpg) no-repeat 50% 0').css('background-size','100% auto');
})
</script>