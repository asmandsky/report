<?php

class m260128_112954_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('user', [
            'id' => 'pk',
            'username' => 'string NOT NULL UNIQUE',
            'password' => 'string NOT NULL',
            'created_at' => 'datetime',
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
	}

	public function down()
	{
        $this->dropTable('user');
	}
}