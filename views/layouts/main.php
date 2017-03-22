<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language = 'zh-CN' ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div id="shadow"></div>
    <div id="sider" title="帮助"><strong>？</strong></div>
    <div id="panel"><button class="close">x</button><pre></pre></div>
    <?php
    NavBar::begin([
        'brandLabel' => isset($_SESSION['Bangpai'])?'天刀帮管__<span style="font-size:16px">'.$_SESSION['Bangpai'].'</span>':'天刀帮管',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest)
    {
        $navItems = [['label' => '未登录',
                    'items' => [
                        ['label' => '登录', 'url' => ['/site/login']],
                        ['label' => '注册', 'url' => ['/site/register']],
                    ]
                ]];
    }
    else{
        $navItems = [];
        if(Yii::getdb()!=null)
        {
            $navItems = [['label' => '入库审批', 'url' => ['/userdata/valid']],
            ['label' => '奖励设置', 'url' => ['/encouragelevel/index'],
                'items' => [
                    ['label' => '设置奖品', 'url' => ['/encouragelevel/gift']],
                    ['label' => '设置奖项', 'url' => ['/encouragelevel/level']],
                ]
            ],
            //['label' => '图片审核', 'url' => ['/site/piccheck']],
            ['label' => '批量录入', 'url' => ['/encourage/inload']],
            ['label' => '查看结果', 'url' => ['/encourage/index']],
            ['label' => '查看历史', 'url' => ['/userdata/index']],
            ['label' => '管理设置', 'url' => ['/site/manage']]];
        }
        array_push($navItems,['label' => '注销 (' . Yii::$app->user->IDentity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]);
    }
    echo Nav::wIDget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 天刀帮管 <?= date('Y') ?></p>

        <p class="pull-right"><a href="http://wjli.tk" target="_blank">E丶曦君</a>&nbsp;制作</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
$(document).ready(function(){
    help_looking();
})
</script>