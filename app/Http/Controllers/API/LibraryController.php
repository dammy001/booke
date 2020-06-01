<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Library;
use App\Http\Controllers\AppBaseController;
use App\Models\Book;
use Response;

class LibraryController extends AppBaseController
{
    private $request;
    private $library;

    public function __construct(Request $request, Library $library)
    {
        $this->request = $request;
        $this->library = $library;
    }

    public function save()
    {
        $this->request->validate([
            'book_id' => 'required'
        ]);

        $check = $this->library->find($this->request->input('book_id'));
        if(!$check){

            $this->library->create([
                'book_id' => $this->request->input('book_id'),
                'user_id' => auth()->user()->id
            ]);
            return $this->sendSuccess('Book added to library');
        }
        return $this->sendError('book added already');
    }

    public function library()
    {
        $myLibrary = $this->library->where('user_id', auth()->user()->id)->get(['book_id', 'created_at']);
        return $this->sendResponse($myLibrary->toArray(), 'success');
    }

    public function deleteLibrary($id)
    {
        $book_id = $this->library
                    ->where('book_id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->get();

        $book_id->delete();
        return $this->sendSuccess('Book deleted from library');

    }

    protected function books($id)
    {
        return Book::where('id', $id)->get();
    }
}
