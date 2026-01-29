<?php

class BookController extends Controller
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
        $books = Book::model()->findAll();

        $this->render('index', array(
            'books' => $books,
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
        $this->render('view', array('book' => $model));
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        $model = new Book();

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($model->save()) {
                    if (isset($_POST['Book']['authors'])) {
                        $authorIds = $_POST['Book']['authors'];
                        $model->saveAuthorLinks($authorIds);
                    }
                    $transaction->commit();
                    Yii::app()->user->setFlash('success', 'Книга успешно создана.');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error', implode('<br>', $model->getErrorsModel()));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'Ошибка при сохранении: ' . $e->getMessage());
            }
        }

        $this->render('create', array(
            'model' => $model,
            'allAuthors' => Author::model()->findAll(),
        ));
    }

    /**
     * @param int $id
     * @return void
     * @throws CHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $selectedAuthors = BookAuthor::model()->findAllByAttributes(array(
            'book_id' => $model->id,
        ));
        $selectedAuthorIds = [];
        foreach ($selectedAuthors as $link) {
            $selectedAuthorIds[] = $link->author_id;
        }

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($model->save()) {
                    if (isset($_POST['Book']['authors'])) {
                        $authorIds = $_POST['Book']['authors'];
                        $model->saveAuthorLinks($authorIds);
                    }
                    $transaction->commit();
                    Yii::app()->user->setFlash('success', 'Книга успешно обновлена.');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error', implode('<br>', $model->getErrorsModel()));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'Ошибка при обновлении: ' . $e->getMessage());
            }
        }

        $this->render('update', array(
            'model' => $model,
            'allAuthors' => Author::model()->findAll(),
            'selectedAuthors' => $selectedAuthorIds,
        ));
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
     * @return array|Book|CActiveRecord|mixed
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        $model = Book::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Запись не найдена.');
        }

        return $model;
    }
}
