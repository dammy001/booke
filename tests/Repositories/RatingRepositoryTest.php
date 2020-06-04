<?php namespace Tests\Repositories;

use App\Models\Rating;
use App\Repositories\RatingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RatingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RatingRepository
     */
    protected $ratingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ratingRepo = \App::make(RatingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rating()
    {
        $rating = factory(Rating::class)->make()->toArray();

        $createdRating = $this->ratingRepo->create($rating);

        $createdRating = $createdRating->toArray();
        $this->assertArrayHasKey('id', $createdRating);
        $this->assertNotNull($createdRating['id'], 'Created Rating must have id specified');
        $this->assertNotNull(Rating::find($createdRating['id']), 'Rating with given id must be in DB');
        $this->assertModelData($rating, $createdRating);
    }

    /**
     * @test read
     */
    public function test_read_rating()
    {
        $rating = factory(Rating::class)->create();

        $dbRating = $this->ratingRepo->find($rating->id);

        $dbRating = $dbRating->toArray();
        $this->assertModelData($rating->toArray(), $dbRating);
    }

    /**
     * @test update
     */
    public function test_update_rating()
    {
        $rating = factory(Rating::class)->create();
        $fakeRating = factory(Rating::class)->make()->toArray();

        $updatedRating = $this->ratingRepo->update($fakeRating, $rating->id);

        $this->assertModelData($fakeRating, $updatedRating->toArray());
        $dbRating = $this->ratingRepo->find($rating->id);
        $this->assertModelData($fakeRating, $dbRating->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rating()
    {
        $rating = factory(Rating::class)->create();

        $resp = $this->ratingRepo->delete($rating->id);

        $this->assertTrue($resp);
        $this->assertNull(Rating::find($rating->id), 'Rating should not exist in DB');
    }
}
