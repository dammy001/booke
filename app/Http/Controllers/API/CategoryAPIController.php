<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */

class CategoryAPIController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->category();
        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    public function show($id)
    {
        $books = $this->categoryRepository->find($id);
        if($books)
            return $this->sendResponse([
                'books' => $books->with('books')->get()
            ],  'Category with books');
    }
}
