<?php

namespace app\models;

use PhpParser\Builder\Param;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "api".
 *
 * @property string $api_id
 * @property string $api_title
 * @property string $api_desc
 * @property string $api_url
 * @property string $api_response
 * @property string $parm_example
 * @property integer $api_type
 * @property integer $pro_id
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%api}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_title', 'api_url', 'api_response', 'api_type', 'pro_id'], 'required'],
            [['api_response', 'parm_example'], 'string'],
            [['api_title', 'api_url'], 'string', 'max' => 50],
            [['api_desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'api_id' => Yii::t('app','api_id'),
            'api_title' => Yii::t('app','api_title'),
            'api_desc' => Yii::t('app','api_desc'),
            'api_url' => Yii::t('app','api_url'),
            'api_response' => Yii::t('app','api_response'),
            'parm_example' => Yii::t('app','parm_example'),
            'api_type' => Yii::t('app','api_type'),
        ];
    }

    public static $type_arr = [
        0 => 'get',
        1 => 'post',
        2 => 'get/post'
    ];

    public function getParams()
    {
        return $this->hasMany(Params::className(), ['api_id' => 'api_id']);
    }

    // 插入数据
    public function saveData()
    {
        $postArr = Yii::$app->getRequest()->post();
        $params = !empty($postArr['Api']['params']) ? $postArr['Api']['params'] : [];
 
        if(!$this->save()) {
            return false;
        }
        $api_id = static::getDb()->getLastInsertID();

        foreach ($params as $tmp) {

            $params_model = new Params();
            $params_model->api_id = $api_id;
            $params_model->parm_name = $tmp['parm_name'];
            $params_model->parm_type = $tmp['parm_type'];
            $params_model->parm_must = $tmp['parm_must'];
            $params_model->parm_desc = $tmp['parm_desc'];

            if(!$params_model->save()) {
                return false;
            }
        }
        return true;
    }

    // 更新数据
    public function updateData()
    {
        $postArr = Yii::$app->getRequest()->post();
        $params = !empty($postArr['Api']['params']) ? $postArr['Api']['params'] : [];

        if(!$this->save()) {
            return false;
        }
        $api_id = Yii::$app->getRequest()->get('id');
        if(!$api_id){
            return false;
        }

        $tempNames = [];
        foreach ($params as $tmp) {
            array_push($tempNames, $tmp['parm_name']);
            // 新增的参数才需要入库！
            if(!$this->isParamExist($tmp['parm_name'])){
                $params_model = new Params();
                $params_model->api_id = $api_id;
                $params_model->parm_name = $tmp['parm_name'];
                $params_model->parm_type = $tmp['parm_type'];
                $params_model->parm_must = $tmp['parm_must'];
                $params_model->parm_desc = $tmp['parm_desc'];

                if(!$params_model->save()) {
                    return false;
                }
            }
        }

        // 删除需要删除的参数
        $notIn = Params::find()
            ->where(['api_id'=>$api_id])
            ->andWhere(['not in', 'parm_name', $tempNames])
            ->all();
        $deleteIds = ArrayHelper::getColumn($notIn, 'parm_id');
        Params::deleteAll(['in','parm_id',$deleteIds]);

        return true;
    }

    // 检查该参数是否已经存在
    private function isParamExist($param_name)
    {
        $hasOne = Params::find()->where(['parm_name' => $param_name])->one();
        return $hasOne ? true : false;
    }
}
