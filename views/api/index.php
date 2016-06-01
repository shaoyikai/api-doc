<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ApiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '接口列表';
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
    <h4>接口索引</h4>
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
        <?= Html::a('创建 Api', ['create','pro_id'=>$pro_id], ['class' => 'btn btn-success']) ?>
    </p>


    <?php foreach ($dataProvider->getModels() as $datas) :?>
        <div class="list">
            <p>
                <a name="mark_<?=$datas['api_id']?>"></a>
                <h4 style="color: orangered;"><?=$datas['api_title']?></h4>
            </p>

            <p>
                <label>接口地址</label>
                [ <?=$datas['api_url']?> ]
            </p>

            <p>
                <label>调用方法</label>
                [ <?=\app\models\Api::$type_arr[$datas['api_type']]?> ]
            </p>

            <p>
            <?php if(!empty($datas['params'])):?>
                <table class="table table-bordered">

                    <tr>
                        <th>参数</th>
                        <th>类型</th>
                        <th>是否可选</th>
                        <th>说明</th>
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
            </p>

            <p>
                <label>返回结果</label>
                <?=$datas['api_response']?>
            </p>

            <p>
                <?=Html::a('编辑',['api/update','id'=>$datas['api_id']])?> |
                <?=Html::a('查看',['api/view','id'=>$datas['api_id']])?>
            </p>
        </div>
        <p class="seperator"></p>
    <?php endforeach; ?>


</div>
