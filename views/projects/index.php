<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app','Create Projects'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            'pro_id',
            'pro_name',
            'pro_code',


            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'buttons' => [

                    'apis' => function ($url, $model) {
                        $url = '/index.php?r=api/index&pro_id=' . $model->pro_id;
                        return Html::a(Yii::t('app', 'Api List'), $url);
                    },
                    'update' => function ($url) {
                        return Html::a(Yii::t('app', 'Update'), $url);
                    },
                    'delete' => function ($url, $model) {

                        $url = '/index.php?r=projects/delete&id=' . $model->pro_id;
                        return Html::a(Yii::t('app', 'Delete'), $url, [
                            'data-confirm' => '确认要删除吗？',
                        ]);

                    },

                ],
                'template' => '{apis} | {update} | {delete}',
            ],
        ],
    ]); ?>

</div>
