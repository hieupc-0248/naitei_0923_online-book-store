<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Unit\ModelTestCase as TestCase;

class OrderTest extends TestCase
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
        $this->runConfigurationAssertions(Order::class, [
            'user_id',
            'total',
            'status',
        ], [], ['*'], [], [
            'id' => 'int',
        ], [
            'created_at',
            'updated_at',
        ]);
    }

    public function testUserRelation()
    {
        $order = new Order();
        $relation = $order->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertBelongsToRelation($relation, $order, new Order(), 'user_id');
    }

    public function testBookRelation()
    {
        $order = new Order();
        $relation = $order->orderDetails();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('order_id', $relation->getForeignKeyName());
        $this->assertHasManyRelation($relation, $order, new Order(), 'order_id');
    }
}
