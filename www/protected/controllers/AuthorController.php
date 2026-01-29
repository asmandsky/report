<?php

class AuthorController extends Controller
{
    /**
     * @return string[]
     */
    public function filters()
    {
        return array('accessControl');
    }

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
    public function actionIndex()
    {
        $authors = Author::model()->findAll();

        $this->render('index', array(
            'authors' => $authors,
        ));
    }

    /**
     * @param int $id
     * @return void
     * @throws CHttpException
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view', array('author' => $model));
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        $model = new Author();
        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Автор успешно создан.');
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', implode('<br>', $model->getErrorsModel()));
            }
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * @return void
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Автор успешно обновлён.');
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                Yii::app()->user->setFlash('error', implode('<br>', $model->getErrorsModel()));
            }
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * @param int $id
     * @return void
     * @throws CDbException
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->loadModel($id);
            $model->delete();

            Yii::app()->user->setFlash('success', 'Запись удалена.');
            $this->redirect(array('index'));
        } else {
            throw new CHttpException(400, 'Некорректный запрос.');
        }
    }

    /**
     * @param int $id
     * @return array|Author|CActiveRecord|mixed
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        $model = Author::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Запись не найдена.');
        }

        return $model;
    }
}
