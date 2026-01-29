<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $allAuthors Author[] */

$this->pageTitle = 'Добавление книги';
?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h1><?= $this->pageTitle ?></h1>

<?php $form = $this->beginWidget('CActiveForm'); ?>

<?php echo CHtml::hiddenField(Yii::app()->request->csrfTokenName, Yii::app()->request->csrfToken); ?>

<div>
    <?php echo $form->label($model, 'title'); ?>
    <?php echo $form->textField($model, 'title'); ?>
</div>

<div>
    <?php echo $form->label($model, 'year'); ?>
    <?php echo $form->textField($model, 'year'); ?>
</div>

<div>
    <?php echo $form->label($model, 'authors'); ?>
    <?php
    // Получаем список авторов для выбора
    $authorList = CHtml::listData($allAuthors, 'id', 'full_name');
    echo CHtml::dropDownList('Book[authors]', array(), $authorList, array(
        'multiple' => 'multiple',
        'size' => 5,
        'prompt' => 'Выберите авторов...',
    ));
    ?>
</div>

<div>
    <button type="submit">Сохранить</button>
</div>

<?php $this->endWidget(); ?>
