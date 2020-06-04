<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Comment;

class CommentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_comment()
    {
        $comment = factory(Comment::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/comments', $comment
        );

        $this->assertApiResponse($comment);
    }

    /**
     * @test
     */
    public function test_read_comment()
    {
        $comment = factory(Comment::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/comments/'.$comment->id
        );

        $this->assertApiResponse($comment->toArray());
    }

    /**
     * @test
     */
    public function test_update_comment()
    {
        $comment = factory(Comment::class)->create();
        $editedComment = factory(Comment::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/comments/'.$comment->id,
            $editedComment
        );

        $this->assertApiResponse($editedComment);
    }

    /**
     * @test
     */
    public function test_delete_comment()
    {
        $comment = factory(Comment::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/comments/'.$comment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/comments/'.$comment->id
        );

        $this->response->assertStatus(404);
    }
}
