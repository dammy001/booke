<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBookAPIRequest;
use App\Http\Requests\API\UpdateBookAPIRequest;
use App\Models\Book;
use App\Models\Admin\Category;
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
        $books = Book::with('category')->get();
        return $this->sendResponse($books->toArray(), 'Books retrieved successfully');
    }

    public function show($id)
    {
       $book = $this->bookRepository->find($id);
       if(!$book)
            return $this->sendError('Book not found');

        return $this->sendResponse([
            'book' => $book
        ], 'Book details');
    }
}
