<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Encourage */

$this->title = 'Create Encourage';
$this->params['breadcrumbs'][] = ['label' => 'Encourages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encourage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gift' => $gift,
    ]) ?>

</div>
