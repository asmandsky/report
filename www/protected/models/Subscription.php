<?php

class Subscription extends CActiveRecord
{
    /**
     * @param $className
     * @return mixed|Subscription
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return 'subscription';
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return array(
            array('email, author_id', 'required'),
            array('email', 'email'),
        );
    }

    /**
     * @return array[]
     */
    public function relations()
    {
        return array(
            'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
        );
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'author_id' => 'Автор',
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
