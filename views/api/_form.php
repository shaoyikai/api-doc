<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Api */
/* @var $form yii\widgets\ActiveForm */

$api_id = isset($model->api_id) ? $model->api_id : 0;
?>
<script type="text/babel" src="react-jsx/params.js"></script>
<script type="text/javascript" src="js/marked.js"></script>

<div class="api-form">

    <?php $form = ActiveForm::begin(); ?>

    <input type="hidden" name="Api[pro_id]" value="<?=$pro_id?>"/>

    <?= $form->field($model, 'api_title')->textInput(['maxlength' => true,'style' => 'width:300px;']) ?>

    <?= $form->field($model, 'api_type')->dropDownList(\app\models\Api::$type_arr,['maxlength' => true,'style' => 'width:100px;']) ?>

    <?= $form->field($model, 'api_desc')->textInput(['maxlength' => true,'style' => 'width:300px;']) ?>

    <?= $form->field($model, 'api_url')->textInput(['maxlength' => true,'style' => 'width:300px;']) ?>

    <div id="params-box"></div>

    <?= $form->field($model, 'api_response')
        ->label('返回结果[MarkDown语法]')
        ->textarea(['style'=>'width:680px;height:350px','onchange'=>'show_content()'])?>

    <label for="api-api_response2">实时预览</label>
    <p id="api-api_response2" class="form-control" style="width:680px;height:350px"></p>
    <?php
//    echo \cliff363825\kindeditor\KindEditorWidget::widget([
//        'model' => $model,
//        'attribute' => 'api_response',
//        'options' => [], // html attributes
//        'clientOptions' => [
//            'width' => '680px',
//            'height' => '350px',
//            'themeType' => 'default', // optional: default, simple, qq
//            'langType' => 'zh-CN',
//            'items' => ['source', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'removeformat', '|', 'code']
//        ],
//    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    //实时显示markdown内容
    function show_content(){
        var inputBox = document.getElementById('api-api_response');
        var showBox = document.getElementById('api-api_response2');

        var newStr = inputBox.value;
        showBox.innerHTML = marked(newStr);
    }
    show_content();
</script>

