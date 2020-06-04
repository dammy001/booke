<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Rating;

class RatingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rating()
    {
        $rating = factory(Rating::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ratings', $rating
        );

        $this->assertApiResponse($rating);
    }

    /**
     * @test
     */
    public function test_read_rating()
    {
        $rating = factory(Rating::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/ratings/'.$rating->id
        );

        $this->assertApiResponse($rating->toArray());
    }

    /**
     * @test
     */
    public function test_update_rating()
    {
        $rating = factory(Rating::class)->create();
        $editedRating = factory(Rating::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ratings/'.$rating->id,
            $editedRating
        );

        $this->assertApiResponse($editedRating);
    }

    /**
     * @test
     */
    public function test_delete_rating()
    {
        $rating = factory(Rating::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ratings/'.$rating->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ratings/'.$rating->id
        );

        $this->response->assertStatus(404);
    }
}
