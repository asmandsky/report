<?php

class ReportController extends Controller
{
    /**
     * @param int|null $year
     * @return void
     */
    public function actionTopAuthors($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }

        $criteria = new CDbCriteria();
        $criteria->select = 't.id, t.full_name, COUNT(book.id) AS book_count';
        $criteria->join = '
            JOIN book_author ba ON t.id = ba.author_id
            JOIN book book ON ba.book_id = book.id
        ';
        $criteria->condition = 'book.year = :year';
        $criteria->params = [':year' => $year];
        $criteria->group = 't.id, t.full_name';
        $criteria->order = 'book_count DESC';
        $criteria->limit = 10;

        $topAuthors = Author::model()->findAll($criteria);

        $result = [];
        foreach ($topAuthors as $author) {
            $result[] = [
                'id' => $author->id,
                'full_name' => $author->full_name,
                'book_count' => (int)$author->book_count,
            ];
        }

        $this->render('topAuthors', [
            'topAuthors' => $result,
            'year' => $year,
        ]);
    }
}