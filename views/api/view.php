<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Api */

$this->title = $model->api_id;
$this->params['breadcrumbs'][] = ['label' => 'Apis', 'url' => ['index', 'pro_id' => $model->pro_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->api_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->api_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'api_id',
            'api_title',
            'api_desc',
            'api_url:url',
            'api_response:ntext',
        ],
    ]) ?>

</div>
