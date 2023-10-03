<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\ProfileController;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Tests\TestCase as TestCase;
use Inertia\Response;
use Mockery;
use Illuminate\Support\Facades\Hash;

class ProfileControllerTest extends TestCase
{
    protected $controller;
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class)
            ->makePartial();
        $this->controller = new ProfileController($this->userRepository);
    }

    public function tearDown(): void
    {
        unset($this->controller);
        Mockery::close();
        parent::tearDown();
    }

    public function testEditFunction()
    {
        $role = Role::create([
            'id' => 2,
            'name' => 'user',
        ]);
        $user = User::factory()->make();
        $request = new Request();

        $this->actingAs($user);
        $response = $this->controller->edit($request);

        $this->assertInstanceOf(View::class, $response);
    }

    public function testUpdateFunction()
    {
        $user = User::factory()->make();
        $request = new ProfileUpdateRequest();

        $response = $this->actingAs($user)->json('POST', '/profile', [$request]);

        $response->assertStatus(405);
    }

    public function testDeleteFunction()
    {
        $user = User::factory()->make();
        $request = new Request();

        $response = $this->actingAs($user)->json('DELETE', '/profile', [$request]);

        $response->assertStatus(405);
    }
}
