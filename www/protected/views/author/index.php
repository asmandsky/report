<?php
/* @var $this AuthorController */
/* @var $authors Author[] */

$this->pageTitle = 'Список авторов';
?>

<h1><?= $this->pageTitle ?></h1>

<?php foreach ($authors as $author): ?>
    <div>
        <h3><?php echo CHtml::encode($author->full_name); ?></h3>
    </div>
<?php endforeach; ?>
