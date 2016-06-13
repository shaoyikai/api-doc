<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Api */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/babel" src="react-jsx/params.js"></script>

<div class="api-form">

    <?php $form = ActiveForm::begin(); ?>

    <input type="hidden" name="Api[pro_id]" value="<?=$pro_id?>"/>

    <?= $form->field($model, 'api_title')->textInput(['maxlength' => true,'style' => 'width:300px;']) ?>

    <?= $form->field($model, 'api_type')->dropDownList(\app\models\Api::$type_arr,['maxlength' => true,'style' => 'width:100px;']) ?>

    <?= $form->field($model, 'api_desc')->textInput(['maxlength' => true,'style' => 'width:300px;']) ?>

    <?= $form->field($model, 'api_url')->textInput(['maxlength' => true,'style' => 'width:300px;']) ?>

    <div id="params-box"></div>
    <!--
    <table class="table table-bordered">
        <tr>
            <th>参数</th>
            <th>类型</th>
            <th>是否可选</th>
            <th>说明</th>
            <th>操作</th>
        </tr>

        <?php if(!empty($params)):?>
            <?php foreach ($params as $par) :?>
                <tr>
                    <td><?=$par['parm_name']?></td>
                    <td><?=$par['parm_type']?></td>
                    <td><?=$par['parm_must']?></td>
                    <td><?=$par['parm_desc']?></td>
                    <td>
                        <?php if($model->isNewRecord):?>
                            <a href="javascript:void(0)" onclick="removeParams(<?=$par['parm_temp_id']?>)" class="btn btn-warning">-</a>
                        <?php else:?>
                            <a href="javascript:void(0)" onclick="removeParamsOne(<?=$par['parm_id']?>)" class="btn btn-warning">-</a>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif;?>

        <tr>
            <td><input type="text" id="par_name"></td>
            <td>
                <select id="par_type">
                    <option value="0" selected>string</option>
                    <option value="1">int</option>
                </select>
            </td>
            <td>
                <select id="par_must">
                    <option value="0" selected>否</option>
                    <option value="1">是</option>
                </select>
            </td>
            <td><input type="text" id="par_desc"></td>

            <td>
                <?php if($model->isNewRecord):?>
                    <a href="javascript:void(0)" onclick="addParams()" class="btn btn-success">+</a>
                <?php else:?>
                    <a href="javascript:void(0)" onclick="addParamsOne()" class="btn btn-success">+</a>
                <?php endif;?>
            </td>

        </tr>
    </table>
    -->
    <label>返回结果</label>
    <?=\cliff363825\kindeditor\KindEditorWidget::widget([
        'model' => $model,
        'attribute' => 'api_response',
        'options' => [], // html attributes
        'clientOptions' => [
            'width' => '680px',
            'height' => '350px',
            'themeType' => 'default', // optional: default, simple, qq
            'langType' => 'zh-CN', // optional: ar, en, ko, zh-CN, zh-TW
            'items' => ['source', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'removeformat', '|', 'code']
        ],
    ])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    //insert
    function addParams()
    {
        var par_name = document.getElementById('par_name').value;
        var par_type = document.getElementById('par_type').value;
        var par_must = document.getElementById('par_must').value;
        var par_desc = document.getElementById('par_desc').value;

        if(!par_name){
            alert('参数名必填');
            return false;
        }

        $.post(
            '<?=\yii\helpers\Url::to(["params/add"])?>',
            {parm_name:par_name,parm_type:par_type,parm_must:par_must,parm_desc:par_desc},
            function(msg){

                if(msg == 1){
                    location.reload();
                }else{
                    console.log(msg);
                    alert('error');
                }
            }
        );
    }

    function removeParams(parm_temp_id)
    {
        $.post(
            '<?=\yii\helpers\Url::to(["params/remove"])?>',
            {id:parm_temp_id},
            function(msg){
                if(msg > 0){
                    location.reload();
                }else{
                    console.log(msg);
                    alert('error');
                }
            }
        );
    }
</script>

<script>
    //update
    function addParamsOne()
    {
        var api_id = <?=$model->api_id?>;
        var par_name = document.getElementById('par_name').value;
        var par_type = document.getElementById('par_type').value;
        var par_must = document.getElementById('par_must').value;
        var par_desc = document.getElementById('par_desc').value;

        if(!par_name){
            alert('参数名必填');
            return false;
        }

        $.post(
            '<?=\yii\helpers\Url::to(["params/add-one"])?>',
            {api_id:api_id, parm_name:par_name, parm_type:par_type, parm_must:par_must, parm_desc:par_desc},
            function(msg){

                if(msg == 1){
                    location.reload();
                }else{
                    console.log(msg);
                    alert('error');
                }
            }
        );
    }

    function removeParamsOne(parm_id)
    {
        $.post(
            '<?=\yii\helpers\Url::to(["params/remove-one"])?>',
            {id:parm_id},
            function(msg){
                if(msg > 0){
                    location.reload();
                }else{
                    console.log(msg);
                    alert('error');
                }
            }
        );
    }
</script>