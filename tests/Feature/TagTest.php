<?php

namespace Tests\Feature;

use App\Livewire\Admin\Tags;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TagTest extends TestCase
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
        $role->givePermissionTo('tag.*');

        Auth::login($this->user);

        $this->user->assignRole($role);

        Tag::factory(2)->create();
    }

    /**
     * @return void
     */
    public function test_index(): void
    {
        Livewire::test(Tags::class)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_create(): void
    {
        Livewire::test(Tags::class)
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
        $tag = Tag::first();

        Livewire::test(Tags::class)
            ->call('update', $tag->id)
            ->set('name', 'test2')
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_delete(): void
    {
        $tag = Tag::first();

        Livewire::test(Tags::class)
            ->call('delete', 'Tag-' . $tag->id)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_search(): void
    {
        Livewire::test(Tags::class)
            ->set('search', 'test')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }
}
