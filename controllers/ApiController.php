<?php

namespace app\controllers;

use app\models\Params;
use app\models\ParamsTemp;
use Yii;
use app\models\Api;
use app\models\search\ApiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApiController implements the CRUD actions for Api model.
 */
class ApiController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Api models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pro_id = Yii::$app->request->get('pro_id');
        if(!$pro_id){
            return $this->goBack();
        }

        $searchModel = new ApiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pro_id' => $pro_id
        ]);
    }

    /**
     * Displays a single Api model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Api model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $pro_id = Yii::$app->request->get('pro_id');
        if(!$pro_id){
            return $this->goBack();
        }
        $model = new Api();

        if ($model->load(Yii::$app->request->post()) && $model->saveData()) {
            return $this->redirect(['index', 'pro_id' => $pro_id,'#'=>'mark_'.$model->api_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'pro_id' => $pro_id
            ]);
        }
    }

    /**
     * Updates an existing Api model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'pro_id' => $model->pro_id,'#'=>'mark_'.$model->api_id]);
        } else {
            $params = Params::find()->where(['api_id'=>$id])->asArray()->all();

            //将 params 以cookie的方式发送给客户端 react 组件 todo
            //js 如何读取cookie todo
            return $this->render('update', [
                'model' => $model,
                'params' => $params
            ]);
        }
    }

    /**
     * Deletes an existing Api model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Api model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Api the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Api::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
