<?php

use yii\db\Schema;
use yii\db\Migration;

class m160601_102938_ap_api extends Migration
{
    const TB_NAME = '{{%api}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT=\'接口表\'';
        }

        $this->createTable(self::TB_NAME, [
            'api_id' => Schema::TYPE_INTEGER . '(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',

            'api_title' => Schema::TYPE_STRING . '(50) NOT NULL',
            'api_desc' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'api_url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'api_response' => Schema::TYPE_TEXT . ' NOT NULL',
            'parm_example' => Schema::TYPE_TEXT . ' DEFAULT NULL',

            'api_type' => Schema::TYPE_SMALLINT . '(2) NOT NULL COMMENT \'0 get 1 post\'',
            'pro_id' => Schema::TYPE_INTEGER . '(11) NOT NULL COMMENT \'项目id\'',

        ]);
    }

    public function down()
    {
        $this->dropTable(self::TB_NAME);
    }


}
