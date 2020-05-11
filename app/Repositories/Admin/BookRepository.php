<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Book;
use App\Models\Admin\Category;
use App\Repositories\BaseRepository;

/**
 * Class BookRepository
 * @package App\Repositories\Admin
 * @version May 8, 2020, 3:55 pm UTC
*/

class BookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'author',
        'type',
        'pages',
        'description',
        'released',
        'image'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Book::class;
    }

    public function category()
    {
        return $this->model->with('category')->get();
    }
}
