<?php
/* @var $this AuthorController */
/* @var $author Author */

$this->pageTitle = 'Автор';
?>

<h1><?= $this->pageTitle ?></h1>

<div>
    <h3><?php echo CHtml::encode($author->full_name); ?></h3>
</div>

<?php echo CHtml::link(
    'Редактировать',
    array('update', 'id' => $author->id),
    ['class' => 'btn btn-primary']
); ?>
