<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Api */

$this->title = $model->api_title;
$this->params['breadcrumbs'][] = ['label' => '接口', 'url' => ['index', 'pro_id' => $model->pro_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->api_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->api_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'api_title',
            'api_desc',
            'api_url:url',
            'api_response:ntext',
        ],
    ]) ?>

</div>
