<?php

namespace Tests\Unit\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\Unit\ModelTestCase as TestCase;

class RiviewTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(Review::class, [
            'content',
            'rating',
            'user_id',
            'book_id',
        ], [], ['*'], [], [
            'id' => 'int',
        ], [
            'created_at',
            'updated_at',
        ]);
    }

    public function testUserRelation()
    {
        $review = new Review();
        $relation = $review->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertBelongsToRelation($relation, $review, new Review(), 'user_id');
    }

    public function testBookRelation()
    {
        $review = new Review();
        $relation = $review->book();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('book_id', $relation->getForeignKeyName());
        $this->assertBelongsToRelation($relation, $review, new Review(), 'book_id');
    }
}
