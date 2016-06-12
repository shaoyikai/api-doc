<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Api: ' . ' ' . $model->api_id;
$this->params['breadcrumbs'][] = ['label' => 'Apis', 'url' => ['index', 'pro_id' => $model->pro_id]];
$this->params['breadcrumbs'][] = ['label' => $model->api_id, 'url' => ['view', 'id' => $model->api_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="api-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="api-form">

        <?= $this->render('_form', [
            'model' => $model,
            'pro_id' => $model->pro_id,
            'params' => $params
        ]) ?>

    </div>

</div>

