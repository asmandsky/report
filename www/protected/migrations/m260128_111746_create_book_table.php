<?php

class m260128_111746_create_book_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('book', [
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'year' => 'integer NOT NULL',
            'description' => 'text',
            'isbn' => 'varchar(13) UNIQUE',
            'image_path' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
    }

    public function down()
    {
        $this->dropTable('book');
    }

}