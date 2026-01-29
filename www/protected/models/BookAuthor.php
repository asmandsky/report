<?php

class BookAuthor extends CActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'book_author';
    }

    /**
     * @param $className
     * @return BookAuthor|mixed
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array[]
     */
    public function relations()
    {
        return array(
            'book' => array(self::BELONGS_TO, 'Book', 'book_id'),
            'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
        );
    }
}
