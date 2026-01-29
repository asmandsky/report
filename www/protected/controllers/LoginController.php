<?php

class LoginController extends CController
{
    /**
     * @return void
     * @throws CException
     */
    public function actionIndex()
    {
        $model = new LoginForm();

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(array('/book'));
            }
        }

        $this->render('login', array('model' => $model));
    }

    /**
     * @return void
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('/'));
    }
}
