<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '创建 Api';
$this->params['breadcrumbs'][] = ['label' => 'Apis', 'url' => ['index', 'pro_id' => $pro_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="api-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="api-form">

        <?= $this->render('_form', [
            'model' => $model,
            'pro_id' => $pro_id,
            'params' => $params
        ]) ?>

    </div>

</div>
