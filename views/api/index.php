<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ApiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Api List');
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('

    div.list{width:600px;margin-bottom:3em;}
    div.list .mark_top{display:inline-block;height:20px;}
    .seperator{height:4px;background:#4cae4c;border-radius:4px;}
    #affix-top{
        border-left:1px solid #ddd;
    }
    #affix-top .nav{margin-bottom:60px;}
    #scrollTop{display:none;}
');

$this->registerJs('

    // 显示结果
    function show_response(){
        var responseAll = $(".show_response");
   
        for (var i=0; i< responseAll.length; i++){
            var brother = $(responseAll[i]).prev();

            var resHtml = brother.html();
            if(isJSON(resHtml)){
                resHtml = formatJson(resHtml);
            }
            var html = "```javascript" + resHtml + "\n```";
            $(responseAll[i]).html(marked(html))
        }
    }
    show_response();

');

?>
<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
<script type="text/javascript" src="js/marked.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<div class="row">

    <div class="col-md-9" role="main">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <a name="preview"></a>
        <?php foreach ($dataProvider->getModels() as $key => $datas) :?>
            <div class="list">
                <div>
                    <a class="mark_top" name="mark_<?=$datas['api_id']?>"></a>
                    <p>
                        <b style="color: orangered;font-size: 16px;"><?=$datas['api_title']?></b>
                        [<?=Html::a(Yii::t('app','Update'),['api/update','id'=>$datas['api_id']])?>]
                    </p>

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
                    <p style="display:none;"><?php echo $datas['api_response']?></p>
                    <p class="show_response"></p>
                </div>

            </div>
            <?php
            // 如果是最后一条数据，不显示分割线
            if($key != (count($dataProvider->getModels()) - 1)){
                echo '<p class="seperator"></p>';
            }
            ?>
        <?php endforeach; ?>

    </div>

    <div class="col-md-3" role="complementary">

        <?= Html::a(Yii::t('app','Create Api'), ['create','pro_id'=>$pro_id], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a('导出文档',['export', 'pro_id'=>$pro_id],['class' => 'btn btn-sm btn-primary']);?>

        <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm" id="affix-top" onclick="affixTop(this)" style="margin-top:10px;">

            <ul class="nav">
                <?php foreach ($dataProvider->getModels() as $values) :?>
                    <li class="nav_list" onclick="setActive(this)"><?=Html::a($values['api_title'],"#mark_".$values['api_id'])?></li>
                <?php endforeach;?>
            </ul>


            <a href="#top" id="scrollTop" style="margin-left:14px;">
                <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon glyphicon-triangle-top" aria-hidden="true"></span> TOP
                </button>
            </a>

        </nav>
    </div>


</div>
<script>

    // 索引页面固定到顶部
    function affixTop(self) {

        self.style.position="fixed";
        self.style.top="70px";
    }

    window.onscroll = function () {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        var nav = document.getElementById("affix-top");
        var scrollTop = document.getElementById("scrollTop");
        if (t < 100) {
            nav.style.position = "";
            scrollTop.style.display = "none";
        } else {
            affixTop(nav)
            scrollTop.style.display = "block";
        }
    };

    function setActive(self){
        //取消li的active
        var lis = document.getElementsByClassName('nav_list');
        for(var i=0;i<lis.length;i++) {
            if(hasClass(lis[i],'active')){
                removeClass(lis[i],'active');
            }
        }
        //当前li增加active
        addClass(self,'active');
    }

    function hasClass(obj, cls) {
        return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    }

    function addClass(obj, cls) {
        if (!this.hasClass(obj, cls)) obj.className += " " + cls;
    }

    function removeClass(obj, cls) {
        if (hasClass(obj, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            obj.className = obj.className.replace(reg, ' ');
        }
    }

</script>

