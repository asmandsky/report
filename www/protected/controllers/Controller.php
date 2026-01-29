<?php

class Controller extends CController
{
    /**
     * @return array[]
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array(
                'allow',
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('?'),
                'message' => 'Для выполнения этого действия требуется авторизация.',
            ),
        );
    }

    /**
     * @return void
     */
    public function init()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('/login'));
        }

        parent::init();
    }
}
