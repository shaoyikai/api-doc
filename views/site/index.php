<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=Yii::t('app','Congratulations!')?></h1>

        <p class="lead"><?=Yii::t('app','You have successfully created your API Doc Builder application.')?></p>

        <p><?=Html::a(Yii::t('app','Get started to create a project!'),['projects/create'],['class'=>'btn btn-lg btn-success'])?></p>
    </div>


</div>
