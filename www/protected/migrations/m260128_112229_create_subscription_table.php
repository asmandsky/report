<?php

class m260128_112229_create_subscription_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('subscription', [
            'id' => 'pk',
            'email' => 'string NOT NULL',
            'author_id' => 'integer NOT NULL',
            'created_at' => 'datetime',
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');

        $this->addForeignKey('fk_subscription_author', 'subscription', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('subscription');
    }

}