<?php

namespace Tests\Unit\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\Unit\ModelTestCase as TestCase;

class MediaTest extends TestCase
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
        $this->runConfigurationAssertions(Media::class, [
            'link',
            'type',
            'book_id',
        ], [], ['*'], [], [
            'id' => 'int',
        ], [
            'created_at',
            'updated_at',
        ]);
    }

    public function testBooksRelation()
    {
        $media = new Media();
        $relation = $media->books();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('books_id', $relation->getForeignKeyName());
        $this->assertBelongsToRelation($relation, $media, new Media(), 'books_id');
    }
}
