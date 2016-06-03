<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ApiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Api List');
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('
    #fixed{width:280px;float:right;position:fixed;margin-left:860px;}
    #fixed ol li{margin:0.2em 0;}
    .api-index{width:800px;}
    div.list{width:600px;margin:3em 0;}
    .seperator{height:4px;background:#4cae4c;border-radius:4px;}
');
?>

<div id="fixed">
    <h4><?=Yii::t('app','Api Index')?></h4>
    <ol>
        <?php foreach ($dataProvider->getModels() as $values) :?>
            <li><?=Html::a($values['api_title'],['api/index', 'pro_id'=>$pro_id, '#'=>'mark_'.$values['api_id']])?></li>
        <?php endforeach;?>
    </ol>
</div>
<div class="api-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app','Create Api'), ['create','pro_id'=>$pro_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php foreach ($dataProvider->getModels() as $datas) :?>
        <div class="list">
            <div>
                <a name="mark_<?=$datas['api_id']?>"></a>
                <h4 style="color: orangered;"><?=$datas['api_title']?></h4>
            </div>

            <div>
                <label><?=Yii::t('app','Api Url')?></label>
                [ <?=$datas['api_url']?> ]
            </div>

            <div>
                <label><?=Yii::t('app','Api Usage')?></label>
                [ <?=\app\models\Api::$type_arr[$datas['api_type']]?> ]
            </div>

            <div>
            <?php if(!empty($datas['params'])):?>
                <table class="table table-bordered">

                    <tr>
                        <th><?=Yii::t('app','Params')?></th>
                        <th><?=Yii::t('app','Type')?></th>
                        <th><?=Yii::t('app','Optional')?></th>
                        <th><?=Yii::t('app','Description')?></th>
                    </tr>

                    <?php foreach ($datas['params'] as $par) :?>
                        <tr>
                            <td><?=$par['parm_name']?></td>
                            <td><?=$par['parm_type']?></td>
                            <td><?=$par['parm_must']?></td>
                            <td><?=$par['parm_desc']?></td>
                        </tr>
                    <?php endforeach ?>

                </table>
            <?php endif;?>
            </div>

            <div>
                <label><?=Yii::t('app','Return Result')?></label>
                <?=$datas['api_response']?>
            </div>

            <div>
                <?=Html::a(Yii::t('app','Update'),['api/update','id'=>$datas['api_id']])?> |
                <?=Html::a(Yii::t('app','View'),['api/view','id'=>$datas['api_id']])?>
            </div>
        </div>
        <p class="seperator"></p>
    <?php endforeach; ?>


</div>
