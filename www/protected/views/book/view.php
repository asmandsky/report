<?php
/* @var $this BookController */
/* @var $book Book */

$this->pageTitle = 'Книга';
?>

<h1><?= $this->pageTitle ?></h1>

<div>
    <h3><?php echo CHtml::encode($book->title); ?></h3>
    <p>Год: <?php echo $book->year; ?></p>
</div>

<?php echo CHtml::link(
    'Редактировать',
    array('update', 'id' => $book->id),
    array('class' => 'btn btn-primary')
); ?>
