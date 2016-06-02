<?php

use yii\db\Schema;
use yii\db\Migration;

class m160601_102930_ap_projects extends Migration
{
    const TB_NAME = '{{%projects}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT=\'项目表\'';
        }

        $this->createTable(self::TB_NAME, [

            'pro_id' => Schema::TYPE_INTEGER . '(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'pro_name' => Schema::TYPE_STRING . '(50) NOT NULL COMMENT \'目项名称\'',
            'pro_code' => Schema::TYPE_STRING . '(20) NOT NULL COMMENT \'项目代码\'',

        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TB_NAME);
    }


}
