<?php

class Book extends CActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'book';
    }

    /**
     * @param $className
     * @return Book|mixed
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('title, year', 'required'),
            array('isbn', 'length', 'max' => 13),
            array('description, authors, image_path', 'safe'),
            array('image_path', 'length', 'max' => 500),
        );
    }

    /**
     * @return array[]
     */
    public function relations()
    {
        return array(
            'authors' => array(
                self::MANY_MANY,
                'Author',
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
            'title' => 'Название',
            'year' => 'Год издания',
            'isbn' => 'ISBN',
            'description' => 'Описание',
            'image_path' => 'Путь к изображению',
            'authors' => 'Авторы',
        );
    }

    /**
     * @param array $authorIds
     * @return true
     * @throws Exception
     */
    public function saveAuthorLinks($authorIds)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'book_id = :book_id';
        $criteria->params = array(':book_id' => $this->id);
        BookAuthor::model()->deleteAll($criteria);

        $data = [];
        foreach ($authorIds as $authorId) {
            $data[] = [$this->id, (int)$authorId];
        }

        foreach ($authorIds as $authorId) {
            $authorId = (int)$authorId;
            if ($authorId <= 0) {
                continue;
            }

            $link = new BookAuthor();
            $link->book_id = $this->id;
            $link->author_id = $authorId;

            $exists = BookAuthor::model()->findByAttributes(array(
                'book_id' => $this->id,
                'author_id' => $authorId
            ));

            if ($exists !== null) {
                continue;
            }

            if (!$link->save()) {
                $errors = $link->getErrors();
                throw new Exception("Ошибка сохранения связи: " . print_r($errors, true));
            }
        }

        return true;
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

