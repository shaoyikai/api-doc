<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Projects;
AppAsset::register($this);


$dropList = Projects::getDropList();
$this->title = Yii::t('app','Api Doc Builder') . ' - ' . $this->title;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app','Api Doc Builder'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right','id' => 'top'],
        'items' => [
            ['label' => Yii::t('app', 'GitHub'), 'url' => 'http://www.github.com/shaoyikai/api-doc'],
            //['label' => Yii::t('app', 'About Us'), 'url' => ['/site/about']],
            ['label' => Yii::t('app','Project'), 'url' => ['/projects/index']],

            count($dropList) ?
            [
                'label' => Yii::t('app', 'API'),
                'items' => $dropList,
            ] : '',

            Yii::$app->user->isGuest ? ['label' => Yii::t('app','Login'), 'url' => ['/site/login']] : [
                'label' => Yii::t('app','Logout') . ' (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],

        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="margin-top: -50px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; shaoyikai@qq.com <?= date('Y') ?></p>

        <p class="pull-right"><?php //echo Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
