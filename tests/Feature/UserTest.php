<?php

namespace Tests\Feature;

use App\Livewire\Admin\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->artisan('db:seed');

        $this->user = User::factory()->create();
        $role = Role::create(['name' => 'role', 'guard_name' => 'web']);
        $role->givePermissionTo('user.*');

        \Illuminate\Support\Facades\Auth::login($this->user);

        $this->user->assignRole($role);
    }

    /**
     * @return void
     */
    public function test_index(): void
    {
        Livewire::test(Users::class)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_delete(): void
    {
        $user = User::factory()->create();

        Livewire::test(Users::class)
            ->call('delete', $user->id)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_syncing_roles_to_users(): void
    {
        $user = User::factory()->create();
        $roles = Role::all()->pluck('name', 'id')->toArray();

        Livewire::test(Users::class)
            ->set('selectedUser', $user)
            ->set('roles', $roles)
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_search(): void
    {
        Livewire::test(Users::class)
            ->set('search', $this->user->mobile)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }
}
