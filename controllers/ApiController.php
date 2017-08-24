<?php

namespace app\controllers;

use app\models\Params;
use app\models\ParamsTemp;
use PhpOffice\PhpWord\PhpWord;
use Yii;
use app\models\Api;
use app\models\search\ApiSearch;
use yii\helpers\ArrayHelper;
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
        if (!$pro_id) {
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
        if (!$pro_id) {
            return $this->goBack();
        }
        $model = new Api();

        if ($model->load(Yii::$app->request->post()) && $model->saveData()) {
            return $this->redirect(['index', 'pro_id' => $pro_id, '#' => 'mark_' . $model->api_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'pro_id' => $pro_id
            ]);
        }
    }

    /**
     * @return \yii\web\Response
     * 以word格式导出api文档
     */
    public function actionExport()
    {
        $pro_id = Yii::$app->request->get('pro_id');
        if (!$pro_id) {
            return $this->goBack();
        }

        $searchModel = new ApiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data = ArrayHelper::toArray($dataProvider->getModels());

        /*-----------------------------------------------------------*/
        $PHPWord = new PhpWord();
        $PHPWord->setDefaultFontSize(14);
        $section = $PHPWord->addSection();

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(16);
        $fontStyle->setColor('006699');
        $myTextElement = $section->addText('1. 登录');
        $myTextElement->setFontStyle($fontStyle);

        $section->addText('接口地址：[ user/login ]');
        $section->addText('使用方法：[ post ]');

        $cellStyle = array('textDirection' => 0, 'bgColor' => '00CCFF');
        $tableStyle = array(
            'cellMarginTop' => 80,
            'cellMarginLeft' => 80,
            'cellMarginRight' => 80,
            'cellMarginBottom' => 80
        );
        $table = $section->addTable($tableStyle);
        $table->addRow(500);
        $table->addCell(2000, $cellStyle)->addText('参数');
        $table->addCell(2000, $cellStyle)->addText('类型');
        $table->addCell(2000, $cellStyle)->addText('是否可选');
        $table->addCell(2000, $cellStyle)->addText('说明');

        $table->addRow();
        $table->addCell(2000)->addText('username');
        $table->addCell(2000)->addText('string');
        $table->addCell(2000)->addText('否');
        $table->addCell(2000)->addText('用户名称');


        $table2 = $section->addTable($tableStyle);
        $table2->addRow(500);
        $table2->addCell(8000, $cellStyle)->addText('返回结果');

        $table2->addRow();
        $table2->addCell(8000)->addText('{"status":"ok"}');


        /*-----------------------------------------------------------*/

        $filename = './docs/helloWorld.docx';
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save($filename);

        // 下载此文件
        Yii::$app->getResponse()->sendFile($filename);
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

        if ($model->load(Yii::$app->request->post()) && $model->updateData()) {
            return $this->redirect(['index', 'pro_id' => $model->pro_id, '#' => 'mark_' . $model->api_id]);
        } else {
            $params = Params::find()->where(['api_id' => $id])->asArray()->all();
            setcookie('params', json_encode($params));
            //将 params 以 cookie 的方式发送给客户端 react 组件

            return $this->render('update', [
                'model' => $model
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
