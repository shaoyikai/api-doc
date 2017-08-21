<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '更新接口: ' . ' ' . $model->api_title;
$this->params['breadcrumbs'][] = ['label' => '接口', 'url' => ['index', 'pro_id' => $model->pro_id]];
$this->params['breadcrumbs'][] = ['label' => $model->api_title, 'url' => ['view', 'id' => $model->api_id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="api-update">

    <div class="api-form">

        <?= $this->render('_form', [
            'model' => $model,
            'pro_id' => $model->pro_id
        ]) ?>

    </div>

</div>

