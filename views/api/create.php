<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '创建接口';
$this->params['breadcrumbs'][] = ['label' => '接口', 'url' => ['index', 'pro_id' => $pro_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="api-create">

    <div class="api-form">

        <?= $this->render('_form', [
            'model' => $model,
            'pro_id' => $pro_id,
        ]) ?>

    </div>

</div>
