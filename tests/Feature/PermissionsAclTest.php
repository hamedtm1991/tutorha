<?php

namespace Tests\Feature;

use App\Livewire\Admin\Acl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermissionsAclTest extends TestCase
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
        $role->givePermissionTo('permission.*');

        Auth::login($this->user);

        $this->user->assignRole($role);
    }

    /**
     * @return void
     */
    public function test_index(): void
    {
        Livewire::test(Acl::class)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_create(): void
    {
        Livewire::test(Acl::class)
            ->call('create')
            ->set('name', 'test')
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_update(): void
    {
        $role = Role::where('name', 'role')->first();

        Livewire::test(Acl::class)
            ->call('update', $role->id)
            ->set('permissions', ['user.create'])
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_delete(): void
    {
        $role = Role::create(['name' => 'test']);

        Livewire::test(Acl::class)
            ->call('delete', $role->id)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_search(): void
    {
        Livewire::test(Acl::class)
            ->set('search', 'test')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }
}
