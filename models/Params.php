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
            'parm_id' => Yii::t('app', 'parm_id'),
            'api_id' => Yii::t('app', 'api_id'),
            'parm_name' => Yii::t('app', 'parm_name'),
            'parm_type' => Yii::t('app', 'parm_type'),
            'parm_must' => Yii::t('app', 'parm_must'),
            'parm_desc' => Yii::t('app', 'parm_desc'),
        ];
    }

    public function getApi()
    {
        return $this->hasOne(Api::className(), ['api_id' => 'api_id']);
    }
}
