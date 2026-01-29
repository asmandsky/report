<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->pageTitle = 'Обновление автора';
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
    <?php echo $form->label($model, 'full_name'); ?>
    <?php echo $form->textField($model, 'full_name'); ?>
</div>

<div>
    <button type="submit">Сохранить</button>
</div>

<?php $this->endWidget(); ?>
