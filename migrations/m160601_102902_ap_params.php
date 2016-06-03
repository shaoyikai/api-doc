<?php

use yii\db\Schema;
use yii\db\Migration;

class m160601_102902_ap_params extends Migration
{
    const TB_NAME = '{{%params}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT=\'参数表\'';
        }

        $this->createTable(self::TB_NAME, [
            'parm_id' => Schema::TYPE_INTEGER . '(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'api_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',

            'parm_name' => Schema::TYPE_STRING . '(50) NOT NULL',
            'parm_type' => Schema::TYPE_STRING . '(255) NOT NULL',
            'parm_must' => Schema::TYPE_SMALLINT . '(2) NOT NULL',
            'parm_desc' => Schema::TYPE_STRING . '(255) DEFAULT NULL',

        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TB_NAME);
    }


}
