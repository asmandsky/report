<?php
/* @var $this BookController */
/* @var $books Book[] */

$this->pageTitle = 'Список книг';
?>

<h1><?= $this->pageTitle ?></h1>

<?php echo CHtml::link(
    'Добавить',
    array('create'),
    ['class' => 'btn btn-primary']
); ?>

<?php foreach ($books as $book): ?>
    <div>
        <h3><?php echo CHtml::encode($book->title); ?></h3>
        <p>Год: <?php echo $book->year; ?></p>
    </div>
<?php endforeach; ?>
