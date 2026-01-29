<?php

class SiteController extends CController
{
    /**
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }
}