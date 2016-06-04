<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ApiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Api List');
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('

    ol li{margin:0.2em 0;}
    div.list{width:600px;margin-bottom:3em;}
    div.list .mark_top{display:inline-block;height:20px;}
    .seperator{height:4px;background:#4cae4c;border-radius:4px;}
');


?>
<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">

<div class="row">

    <div class="col-md-9" role="main">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a(Yii::t('app','Create Api'), ['create','pro_id'=>$pro_id], ['class' => 'btn btn-success']) ?>
        </p>

        <a name="preview"></a>
        <?php foreach ($dataProvider->getModels() as $datas) :?>
            <div class="list">
                <div>
                    <a class="mark_top" name="mark_<?=$datas['api_id']?>"></a>
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

    <div class="col-md-3" role="complementary">
        <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm" id="affix-top" onclick="affixTop(this)">
            <h3><?=Yii::t('app','Api Index')?></h3>
            <ul class="nav">
                <li class="active"><a href="#preview">用户</a>
                    <ul class="nav">
                        <?php foreach ($dataProvider->getModels() as $values) :?>
                            <li><?=Html::a($values['api_title'],"#mark_".$values['api_id'])?></li>
                        <?php endforeach;?>

                    </ul>
                </li>

                <li class=""><a href="#preview ">商品</a>
                    <ul class="nav">
                        <li><a href="#mark_1">登录</a></li>
                        <li><a href="#mark_2">注册</a></li>

                    </ul>
                </li>

            </ul>

            <a class="back-to-top" href="#top">
                <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon glyphicon-triangle-top" aria-hidden="true"></span>TOP
                </button>
            </a>

        </nav>
    </div>


</div>
<script>

    // 索引页面固定到顶部
    function affixTop(self) {

        self.style.position="fixed";
        self.style.top="20px";
    }

    window.onscroll = function () {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        var nav = document.getElementById("affix-top");
        if (t < 100) {
            nav.style.position = "";
        }else{
            affixTop(nav)
        }
    }

</script>