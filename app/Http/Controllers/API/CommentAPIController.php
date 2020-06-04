<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCommentAPIRequest;
use App\Http\Requests\API\UpdateCommentAPIRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CommentController
 * @package App\Http\Controllers\API
 */

class CommentAPIController extends AppBaseController
{
    /** @var  CommentRepository */
    private $commentRepository;
    private $request;
    private $bookRepository;

    public function __construct(CommentRepository $commentRepo, Request $request, BookRepository $bookRepository)
    {
        $this->commentRepository = $commentRepo;
        $this->request = $request;
        $this->bookRepo = $bookRepository;
    }

    public function comments($id)
    {
        $book = $this->bookRepo->find($id);

        $comments = $book->comments;

        return $this->sendSuccess($comments->toArray());
    }

    public function save()
    {
        $this->request->validate([
            'message' => 'required'
        ]);

        $book = $this->bookRepo->find($this->request->input('book_id'));

        $book->comments()->create([
            'user_id' => auth()->user()->name,
            'message' => $this->request->input('message')
        ]);

        return $this->sendSuccess('Comment Added');
    }

}
