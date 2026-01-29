<?php

class m260128_111538_create_author_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('author', array(
            'id' => 'pk',
            'full_name' => 'string NOT NULL',
            'created_at' => 'datetime',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
    }

    public function down()
    {
        $this->dropTable('author');
    }

}