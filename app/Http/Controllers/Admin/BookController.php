<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Repositories\Admin\BookRepository;
use App\Repositories\Admin\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BookController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;
    private $categoryRepository;

    public function __construct(BookRepository $bookRepo, CategoryRepository $categoryRepo)
    {
        $this->bookRepository = $bookRepo;
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Book.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $books = $this->bookRepository->category();
        return view('admin.books.index')
            ->with('books', $books);
    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        $select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
        }
        return view('admin.books.create', compact('select'));
    }

    /**
     * Store a newly created Book in storage.
     *
     * @param CreateBookRequest $request
     *
     * @return Response
     */
    public function store(CreateBookRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        $book = $this->bookRepository->create($input);

        Flash::success('Book saved successfully.');

        return redirect(route('admin.books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('admin.books.index'));
        }

        return view('admin.books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->bookRepository->find($id);
        $categories = $this->categoryRepository->all();
        $select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
        }

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('admin.books.index'));
        }

        return view('admin.books.edit', compact('book', 'select'));
    }

    /**
     * Update the specified Book in storage.
     *
     * @param int $id
     * @param UpdateBookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookRequest $request)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('admin.books.index'));
        }

        $book = $this->bookRepository->update($request->all(), $id);

        Flash::success('Book updated successfully.');

        return redirect(route('admin.books.index'));
    }

    /**
     * Remove the specified Book from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('admin.books.index'));
        }

        $this->bookRepository->delete($id);

        Flash::success('Book deleted successfully.');

        return redirect(route('admin.books.index'));
    }
}
