<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = Yii::t('app','Create Projects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
