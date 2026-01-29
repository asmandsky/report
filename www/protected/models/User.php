<?php

class User extends CActiveRecord
{
    /**
     * @param $className
     * @return mixed|User
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
        return 'user';
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('username', 'unique'),
        );
    }
}
