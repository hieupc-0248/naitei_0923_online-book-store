<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Unit\ModelTestCase as TestCase;

class RoleTest extends TestCase
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
        $this->runConfigurationAssertions(Role::class, [
            'id',
            'name',
        ], [], ['*'], [], [
            'id' => 'int',
        ], []);
    }

    public function testOrdersRelation()
    {
        $role = new Role();
        $relation = $role->users();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertHasManyRelation($relation, $role, new Role(), 'role_id');
    }
}
