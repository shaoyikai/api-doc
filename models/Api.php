<?php

namespace app\models;

use Yii;

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
            'api_id' => 'Api ID',
            'api_title' => '名称',
            'api_desc' => '描述',
            'api_url' => '接口地址',
            'api_response' => '返回结果',
            'parm_example' => '参数示例',
            'api_type' => '传参方式',
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

    public function saveData()
    {
        if(!$this->save())
        {
            return false;
        }

        $api_id = static::getDb()->getLastInsertID();
        $temp_model = ParamsTemp::find()->all();
        if (!empty($temp_model)) {
            foreach ($temp_model as $tmp) {
                $params_model = new Params();
                $params_model->api_id = $api_id;
                $params_model->parm_name = $tmp->parm_name;
                $params_model->parm_type = $tmp->parm_type;
                $params_model->parm_must = $tmp->parm_must;
                $params_model->parm_desc = $tmp->parm_desc;
                if(!$params_model->save())
                {
                    return false;
                }
            }
        }

        return true;
    }
}
