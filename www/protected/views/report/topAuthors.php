<?php
/* @var $this ReportController */
/* @var int $year */
/* @var array $topAuthors */

$this->pageTitle = 'ТОП-10';
?>

<div class="top-authors-container">
    <h1><?= $this->pageTitle ?> авторов за <?php echo $year; ?> год</h1>

    <?php if (empty($topAuthors)): ?>
        <p class="no-data">Нет данных о публикациях за этот год.</p>
    <?php else: ?>
        <table class="authors-table">
            <thead>
            <tr>
                <th class="author-name">Автор</th>
                <th class="book-count">Количество книг</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($topAuthors as $author): ?>
                <tr class="author-row">
                    <td class="author-cell">
                            <span class="author-name-text">
                                <?php echo CHtml::encode($author['full_name']); ?>
                            </span>
                    </td>
                    <td class="count-cell">
                            <span class="book-count-badge">
                                <?php echo (int)$author['book_count']; ?>
                            </span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<style>
    .top-authors-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    h1 {
        color: #1a1a1a;
        text-align: center;
        margin-bottom: 24px;
        font-size: 1.8rem;
        letter-spacing: -0.5px;
    }

    .no-data {
        text-align: center;
        color: #666;
        font-style: italic;
        margin: 40px 0;
        font-size: 1.1rem;
    }

    .authors-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    }

    .authors-table thead {
        background: linear-gradient(135deg, #0e509e, #1d84b5);
    }

    .authors-table th {
        color: white;
        text-align: left;
        padding: 14px 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .author-row {
        transition: background-color 0.3s ease;
    }

    .author-row:hover {
        background-color: #f0f8ff;
    }

    .author-cell,
    .count-cell {
        padding: 16px 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .author-name-text {
        font-size: 1.05rem;
        color: #2c3e50;
        font-weight: 500;
    }

    .book-count-badge {
        display: inline-block;
        padding: 6px 12px;
        background-color: #1d84b5;
        color: white;
        border-radius: 20px;
        font-weight: 600;
        min-width: 60px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(29, 132, 181, 0.2);
    }

    /* Адаптивность */
    @media (max-width: 600px) {
        .top-authors-container {
            margin: 15px;
            padding: 15px;
        }

        h1 {
            font-size: 1.5rem;
        }

        .authors-table th,
        .author-cell,
        .count-cell {
            padding: 12px 15px;
            font-size: 0.95rem;
        }

        .book-count-badge {
            min-width: 50px;
            padding: 5px 10px;
            font-size: 0.9rem;
        }
    }
</style>
