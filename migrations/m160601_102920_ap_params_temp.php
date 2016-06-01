<?php

use yii\db\Schema;
use yii\db\Migration;

class m160601_102920_ap_params_temp extends Migration
{
    const TB_NAME = '{{%params_temp}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT=\'参数临时表\'';
        }

        $this->createTable(self::TB_NAME, [

            'parm_temp_id' => Schema::TYPE_INTEGER . '(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',

            'parm_name' => Schema::TYPE_STRING . '(50) NOT NULL',
            'parm_type' => Schema::TYPE_STRING . '(255) NOT NULL',
            'parm_must' => Schema::TYPE_SMALLINT . '(2) NOT NULL',
            'parm_desc' => Schema::TYPE_STRING . '(255) NOT NULL',

        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TB_NAME);
    }


}
