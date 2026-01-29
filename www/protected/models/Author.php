<?php

class Author extends CActiveRecord
{
    /** @var int */
    public $book_count;

    /**
     * @return string
     */
    public function tableName()
    {
        return 'author';
    }

    /**
     * @param $className
     * @return Author|mixed
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('full_name', 'required'),
            array('full_name', 'length', 'max' => 255),
        );
    }

    /**
     * @return array[]
     */
    public function relations()
    {
        return array(
            'books' => array(
                self::MANY_MANY,
                'Book',
                'book_author(book_id, author_id)'
            ),
        );
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'full_name' => 'Имя',
        );
    }

    /**
     * @return array
     */
    public function getErrorsModel()
    {
        $errors = $this->getErrors();

        $errorMessages = [];

        foreach ($errors as $attribute => $messages) {
            foreach ($messages as $message) {
                $errorMessages[] = "$attribute: $message";
            }
        }

        return $errorMessages;
    }
}
