<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\Unit\ModelTestCase as TestCase;

class UserTest extends TestCase
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
        $this->runConfigurationAssertions(User::class, [
            'first_name',
            'last_name',
            'phone',
            'address',
            'email',
            'password',
        ], [
            'password',
            'remember_token',
        ], ['*'], [], [
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ]);
    }

    public function testRoleRelation()
    {
        $user = new User();
        $relation = $user->role();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertBelongsToRelation($relation, $user, new User(), 'role_id');
    }

    public function testReviewsRelation()
    {
        $user = new User();
        $relation = $user->reviews();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertHasManyRelation($relation, $user, new User(), 'user_id');
    }

    public function testCartsRelation()
    {
        $user = new User();
        $relation = $user->carts();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertHasManyRelation($relation, $user, new User(), 'user_id');
    }

    public function testOrdersRelation()
    {
        $user = new User();
        $relation = $user->orders();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertHasManyRelation($relation, $user, new User(), 'user_id');
    }
}
