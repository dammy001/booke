<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use JD\Cloudder\Facades\Cloudder;

/**
 * Class BookRepository
 * @package App\Repositories
 * @version May 12, 2020, 12:39 am UTC
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
        'image',
        'user_id',
        'category_id'
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

    public function upload($folder, UploadedFile $image): array
    {
        return Cloudder::upload($image->getRealPath(), null, ['folder' => $folder], [])->getResult();
    }

    public function category()
    {
        return $this->model->with('category')->get();
    }

    public function justIn()
    {
        return $this->model->with('category')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    }

    public function related($id)
    {
        $book = $this->model->newQuery()->where('id', $id)->first();

        $related = $this->model->where('category_id','=',$book->category_id)
        ->take(6)
        ->get(['title', 'author', 'image']);

        return $related;
    }


}
