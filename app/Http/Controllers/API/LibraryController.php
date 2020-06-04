<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Library;
use App\Http\Controllers\AppBaseController;
use App\Repositories\LibraryRepository;
use App\Repositories\BookRepository;
use Response;

class LibraryController extends AppBaseController
{
    private $request;
    private $libraryRepository;
    private $bookRepository;

    public function __construct(Request $request, LibraryRepository $libraryRepository, BookRepository $bookRepository)
    {
        $this->request = $request;
        $this->libraryRepo = $libraryRepository;
        $this->bookRepo = $bookRepository;
    }

    public function save()
    {
        $book = $this->bookRepo->find($this->request->input('book_id'));

        $findBookId = Library::query()
            ->where('user_id', auth()->user()->id)
            ->where('book_id', $book->id)
            ->first();

        if(!$findBookId){
            $get = $this->libraryRepo->save($book, auth()->user());
            return $this->sendResponse($get->toArray(), 'Book added successfully');
        }
        return $this->sendError('Book Added Already');
    }

    public function library()
    {
        $myLibrary = $this->libraryRepo->library(auth()->user());

        return $this->sendResponse($myLibrary->toArray(), 'success');
    }

    public function deleteLibrary($id)
    {
        $delete = $this->libraryRepo->deleteBook($id, auth()->user());
            if($delete)
                return $this->sendSuccess('Book Deleted From Library');
    }
}
