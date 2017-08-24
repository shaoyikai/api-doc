<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Api */
/* @var $form yii\widgets\ActiveForm */

$api_id = isset($model->api_id) ? $model->api_id : 0;
?>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/marked.js"></script>
<script type="text/babel" src="react-jsx/params.js"></script>

<div class="api-form">

    <?php $form = ActiveForm::begin([
            'options'=>['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "<div class='col-xs-3 col-sm-2 text-right'>{label}</div><div class='col-xs-5 col-sm-6'>{input}{error}</div>",
                ]
    ]); ?>

    <input type="hidden" name="Api[pro_id]" value="<?=$pro_id?>"/>

    <?= $form->field($model, 'api_title')->textInput(['maxlength' => true,'class' => 'form-control']) ?>

    <?= $form->field($model, 'api_type')->dropDownList(\app\models\Api::$type_arr,['maxlength' => true,'style' => 'width:100px;']) ?>

    <?= $form->field($model, 'api_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_url')->textInput(['maxlength' => true]) ?>

    <div id="params-box"></div>

    <div class="form-group">
        <div class="col-xs-3 col-sm-2 text-right">
            <label class="control-label" for="api-api_type">返回结果</label>
        </div>

        <div class="col-xs-9 col-sm-9">
            <?= $form->field($model, 'api_response',['template'=>'<div class="col-xs-6">{input}{error}</div><div id="api-api_response2" class="col-xs-6" style="height:350px;overflow-y:auto;border:1px solid #ccc"></div>'])
                ->textarea(['style'=>'height:350px;','placeholder'=>'json示例','onkeyup'=>'show_content()'])?>

        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 col-sm-2"></div>

        <div class="col-xs-9 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    //实时显示markdown内容
    function show_content(){
        var inputBox = document.getElementById('api-api_response');
        var showBox = document.getElementById('api-api_response2');

        var value = isJSON(inputBox.value) ? formatJson(inputBox.value) : inputBox.value;
        var newStr = '```javascript' + value + '\n```';
        showBox.innerHTML = marked(newStr);
    }
    show_content();


</script>