<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tmp */

$this->title = 'Update Tmp: ' . $model->UID;
$this->params['breadcrumbs'][] = ['label' => 'Tmps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UID, 'url' => ['view', 'id' => $model->UID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tmp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
