<?php

class SubscriptionController extends Controller
{
    /**
     * @return void
     */
    public function actionSubscribe()
    {
        $model = new Subscription();

        if (isset($_POST['Subscription'])) {
            $model->attributes = $_POST['Subscription'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Вы подписаны!');
                $this->redirect(array('/author/index'));
            } else {
                Yii::app()->user->setFlash('error', implode('<br>', $model->getErrorsModel()));
            }
        }

        $this->render('subscribe', array(
            'model' => $model,
            'allAuthors' => Author::model()->findAll(),
        ));
    }
}
