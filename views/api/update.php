<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Api: ' . ' ' . $model->api_id;
$this->params['breadcrumbs'][] = ['label' => 'Apis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->api_id, 'url' => ['view', 'id' => $model->api_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="api-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="api-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'api_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'api_desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'api_url')->textInput(['maxlength' => true]) ?>

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
                        <td><a href="javascript:void(0)" onclick="removeParams(<?=$par['parm_id']?>)" class="btn btn-warning">-</a> </td>

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

                <td><a href="javascript:void(0)" onclick="addParams()" class="btn btn-success">+</a> </td>

            </tr>
        </table>

        <label>返回结果</label>
        <?=\cliff363825\kindeditor\KindEditorWidget::widget([
            'model' => $model,
            'attribute' => 'api_response',
            'options' => [], // html attributes
            'clientOptions' => [
                'width' => '680px',
                'height' => '350px',
                'themeType' => 'default', // optional: default, simple, qq
                'langType' => 'zh_CN', // optional: ar, en, ko, zh_CN, zh_TW
                'items' => ['source', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'removeformat', '|', 'code']
            ],
        ])?>

        <div class="form-group">
            <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<script>
    function addParams()
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

    function removeParams(parm_id)
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