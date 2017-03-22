<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bangpai */

$this->title = '新建帮派';
$this->params['breadcrumbs'][] = ['label' => '我的帮派', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bangpai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'daqv' => $daqv,
        'fuwuqi' => $fuwuqi,
    ]) ?>

</div>
