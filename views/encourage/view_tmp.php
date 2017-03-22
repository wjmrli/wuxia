<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tmp */

$this->title = $base['游戏ID'];
$this->params['breadcrumbs'][] = ['label' => '查看结果', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('删除', ['delete', 'id' => $base['ID']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
            
        ]) ?>
    </p>
    <div class="col-lg-5">
        <table id="w0" class="table table-striped table-bordered detail-view">
            <tbody>
            <?php unset($base['ID']);
                foreach($base as $key => $val):
                echo"<tr><th>".$key."</th><td>".$val."</td></tr>";
                endforeach; 
                foreach($gift as $key => $val):
                echo"<tr><th>".$key."</th><td>".$val."</td></tr>";
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
