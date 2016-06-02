<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "params_temp".
 *
 * @property string $parm_temp_id
 * @property string $parm_name
 * @property string $parm_type
 * @property integer $parm_must
 * @property string $parm_desc
 */
class ParamsTemp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%params_temp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parm_name', 'parm_type', 'parm_must'], 'required'],
            [['parm_must'], 'integer'],
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
            'parm_temp_id' => 'Parm Temp ID',
            'parm_name' => 'Parm Name',
            'parm_type' => 'Parm Type',
            'parm_must' => 'Parm Must',
            'parm_desc' => 'Parm Desc',
        ];
    }
}
