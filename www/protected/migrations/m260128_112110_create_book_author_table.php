<?php

class m260128_112110_create_book_author_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('book_author', [
            'book_id' => 'integer NOT NULL',
            'author_id' => 'integer NOT NULL',
        ]);

        $this->addPrimaryKey('pk_book_author', 'book_author', ['book_id', 'author_id']);
        $this->addForeignKey('fk_book', 'book_author', 'book_id', 'book', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_author', 'book_author', 'author_id', 'author', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('book_author');
    }

}