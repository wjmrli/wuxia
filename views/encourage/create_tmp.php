<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tmp */

$this->title = 'Create Tmp';
$this->params['breadcrumbs'][] = ['label' => 'Tmps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
