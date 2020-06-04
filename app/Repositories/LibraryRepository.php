<?php

namespace App\Repositories;

use App\Models\Library;
use App\Repositories\BaseRepository;

/**
 * Class LibraryRepository
 * @package App\Repositories
 * @version June 2, 2020, 12:54 pm UTC
*/

class LibraryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

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

    public function save($book, $user)
    {
        $save = $this->model->create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'title' => $book->title,
            'image' => $book->image
        ]);
        return $save;
    }

    public function library($user)
    {
        return $this->model->query()->where('user_id', $user->id)->get(['book_id', 'title', 'image', 'created_at']);
    }

    public function check($user)
    {
        return $this->model->query()->where('user_id', $user->id)->first();
    }

    public function deleteBook($id, $user)
    {
        return $this->model->query()
        ->where('user_id', auth()->user()->id)
        ->where('book_id', $id)
        ->delete();
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Library::class;
    }
}
