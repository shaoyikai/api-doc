<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property string $parm_id
 * @property integer $api_id
 * @property string $parm_name
 * @property string $parm_type
 * @property integer $parm_must
 * @property string $parm_desc
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%params}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_id', 'parm_name', 'parm_type', 'parm_must'], 'required'],
            [['api_id', 'parm_must'], 'integer'],
            [['parm_name'], 'string', 'max' => 50],
            [['parm_type', 'parm_desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parm_id' => 'Parm ID',
            'api_id' => 'Api ID',
            'parm_name' => '参数名',
            'parm_type' => '类型',
            'parm_must' => '是否必须',
            'parm_desc' => '描述',
        ];
    }

    public function getApi()
    {
        return $this->hasOne(Api::className(), ['api_id' => 'api_id']);
    }
}
