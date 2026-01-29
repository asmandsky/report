<?php
/* @var $this SubscriptionController */
/* @var $model Subscription */
/* @var $allAuthors Author[] */

$this->pageTitle = 'Подпишитесь на автора';
?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'subscription-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form'),
)); ?>

<h1><?= $this->pageTitle ?></h1>

<div>
    <?php echo $form->label($model, 'email'); ?>
    <?php echo $form->textField($model, 'email'); ?>
</div>

<div>
    <?php echo $form->label($model, 'author_id'); ?>
    <?php
    $authorList = CHtml::listData($allAuthors, 'id', 'full_name');
    echo $form->dropDownList(
        $model,
        'author_id',
        $authorList,
        array('class' => 'form-control', 'prompt' => 'Выберите автора...')
    );
    ?>
</div>

<div>
    <?php echo CHtml::submitButton('Подписаться'); ?>
</div>

<?php $this->endWidget(); ?>