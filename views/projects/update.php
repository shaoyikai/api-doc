<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = Yii::t('app','Update Projects: ') . ' ' . $model->pro_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pro_name, 'url' => ['view', 'id' => $model->pro_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="projects-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
