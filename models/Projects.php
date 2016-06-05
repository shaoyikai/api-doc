<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            'pro_id' => Yii::t('app', 'pro_id'),
            'pro_name' => Yii::t('app', 'pro_name'),
            'pro_code' => Yii::t('app', 'pro_code'),
        ];
    }

    /**
     * @return array
     * 获取项目列表
     */
    public static function getDropList()
    {
        $dropList = [];
        $data = Yii::$app->getCache()->get('dropList');

        if($data == false){
            $model = Projects::find()->asArray()->all();
            $arr = ArrayHelper::map($model, 'pro_name', 'pro_id');
            foreach ($arr as $name => $pro_id) {
                $dropList[] = ['label'=>$name, 'url'=> ['api/index','pro_id'=>$pro_id]];
            }

            // 缓存时间为1小时
            Yii::$app->getCache()->set('dropList', $dropList, Yii::$app->params['cacheTime']);
        }

        return $data;
    }
}
