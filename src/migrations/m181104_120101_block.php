<?php

namespace thienhungho\Block\migrations;

use yii\db\Schema;

class m181104_120101_block extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%block}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(255)->notNull(),
            'content'     => $this->text()->notNull(),
            'author'      => $this->integer(19),
            'language'    => $this->string(255),
            'assign_with' => $this->integer(19),
            'created_at'  => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at'  => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by'  => $this->integer(19),
            'updated_by'  => $this->integer(19),
            'FOREIGN KEY ([[author]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%block}}');
    }
}
