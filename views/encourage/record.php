<?php
use yii\helpers\Html;
$this->title = '记录: '.$model->r->Record;
$this->params['breadcrumbs'][] = ['label' => '批量录入', 'url' => ['inload']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-5" >
    <pre class="xdebug-var-dump" >
        
        <div><h4><strong>输入数据:</strong></h4><p>模糊开关：<?=$model->Blur==0?'关':'开'?>
        游戏ID所在列：<?=$model->Col?>
        奖品：<?=$model->r->Gift?><br/>数量：<?=$model->r->Number?>
        操作者：<?=$model->r->Manager?></p></div><?=Html::a('删除',['recorddel','id'=>$model->RID],['class'=>'btn btn-danger','style'=>'float:right','onclick'=>'return confirm("将会删除该记录及其涉及的奖励，确定吗?")'])?></pre>
        <div style="overflow: auto;height:300px"><pre class="xdebug-var-dump"><p><?=$model->Source?></p></pre></div>
</div>
<div class="col-lg-5" style="">
    <pre class="xdebug-var-dump">
        <div><h4><strong>执行结果:</strong></h4><p><?=$model->Result?></p>
        </div>
   </pre>
</div>