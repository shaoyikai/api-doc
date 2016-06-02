<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property string $pro_id
 * @property string $pro_name
 * @property string $pro_code
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_name', 'pro_code'], 'required'],
            [['pro_name'], 'string', 'max' => 50],
            [['pro_code'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => '目项id',
            'pro_name' => '目项名称',
            'pro_code' => '项目代码',
        ];
    }
}
