<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBookAPIRequest;
use App\Http\Requests\API\UpdateBookAPIRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BookController
 * @package App\Http\Controllers\API
 */

class BookAPIController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;
    private $request;

    public function __construct(BookRepository $bookRepo, Request $request)
    {
        $this->bookRepository = $bookRepo;
        $this->request = $request;
    }

    /**
     * Display a listing of the Book.
     * GET|HEAD /books
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $books = $this->bookRepository->category();
        return $this->sendResponse($books->toArray(), 'Books retrieved successfully');
    }

    public function show($id)
    {
       $book = $this->bookRepository->find($id);
       if(!$book)
            return $this->sendError('Book not found');

        $related = $this->bookRepository->related($book);
        $booksByAuthor = $this->bookRepository->booksByAuthor($book);

        return $this->sendResponse([
            'book' => $book,
            'related' => $related,
            'authorBooks' => $booksByAuthor
        ], 'Book details');
    }

    public function justIn()
    {
        $books = $this->bookRepository->justIn();
        return $this->sendResponse($books->toArray(), 'Books Retrieved Successfully');
    }

    public function popular()
    {
        $books = $this->bookRepository->popular();
        return $this->sendResponse($books->toArray(), 'Books Retrieved Successfully');
    }
}
