<?php namespace app\controllers;

use app\models\Params;
use app\models\ParamsTemp;
use yii\web\Controller;
use Yii;
/**
 * 功能: Params 控制器
 * 时间: 2016-01-11 下午 2:09
 * 作者：shaoyikai@acttao.com
 */
class ParamsController extends Controller{

    public function actionAdd()
    {
        $parm_name = Yii::$app->request->post('parm_name');
        $parm_type = Yii::$app->request->post('parm_type');
        $parm_must = Yii::$app->request->post('parm_must');
        $parm_desc = Yii::$app->request->post('parm_desc');

        $model = new ParamsTemp();
        $model->parm_name = $parm_name;
        $model->parm_type = $parm_type;
        $model->parm_must = $parm_must;
        $model->parm_desc = $parm_desc;

        if ($model->save()) {
            echo 1;
        } else {
            print_r($model->getErrors());
        }
    }

    public function actionRemove()
    {
        $id = Yii::$app->request->post('id');
        $model = ParamsTemp::findOne($id);
        if (empty($model)) {
            echo 0;
        } else {
            if($model->delete()){
                echo 1;
            }else{
                print_r($model->getErrors());
            }
        }

    }

    public function actionAddOne()
    {
        $api_id = Yii::$app->request->post('api_id');
        $parm_name = Yii::$app->request->post('parm_name');
        $parm_type = Yii::$app->request->post('parm_type');
        $parm_must = Yii::$app->request->post('parm_must');
        $parm_desc = Yii::$app->request->post('parm_desc');

        $model = new Params();
        $model->api_id = $api_id;
        $model->parm_name = $parm_name;
        $model->parm_type = $parm_type;
        $model->parm_must = $parm_must;
        $model->parm_desc = $parm_desc;

        if ($model->save()) {
            echo 1;
        } else {
            print_r($model->getErrors());
        }
    }

    public function actionRemoveOne()
    {
        $id = Yii::$app->request->post('id');
        $model = Params::findOne($id);
        if (empty($model)) {
            echo 0;
        } else {
            if($model->delete()){
                echo 1;
            }else{
                print_r($model->getErrors());
            }
        }
    }

}
