<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Userdata */

$this->title = '激活游戏ID';
$this->params['breadcrumbs'][] = ['label' => '激活审核', 'url' => ['valid']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'msg' => isset($msg)?  $msg:null
    ]) ?>

</div>
