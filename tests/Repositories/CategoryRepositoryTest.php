<?php namespace Tests\Repositories;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->categoryRepo = \App::make(CategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_category()
    {
        $category = factory(Category::class)->make()->toArray();

        $createdCategory = $this->categoryRepo->create($category);

        $createdCategory = $createdCategory->toArray();
        $this->assertArrayHasKey('id', $createdCategory);
        $this->assertNotNull($createdCategory['id'], 'Created Category must have id specified');
        $this->assertNotNull(Category::find($createdCategory['id']), 'Category with given id must be in DB');
        $this->assertModelData($category, $createdCategory);
    }

    /**
     * @test read
     */
    public function test_read_category()
    {
        $category = factory(Category::class)->create();

        $dbCategory = $this->categoryRepo->find($category->id);

        $dbCategory = $dbCategory->toArray();
        $this->assertModelData($category->toArray(), $dbCategory);
    }

    /**
     * @test update
     */
    public function test_update_category()
    {
        $category = factory(Category::class)->create();
        $fakeCategory = factory(Category::class)->make()->toArray();

        $updatedCategory = $this->categoryRepo->update($fakeCategory, $category->id);

        $this->assertModelData($fakeCategory, $updatedCategory->toArray());
        $dbCategory = $this->categoryRepo->find($category->id);
        $this->assertModelData($fakeCategory, $dbCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_category()
    {
        $category = factory(Category::class)->create();

        $resp = $this->categoryRepo->delete($category->id);

        $this->assertTrue($resp);
        $this->assertNull(Category::find($category->id), 'Category should not exist in DB');
    }
}
