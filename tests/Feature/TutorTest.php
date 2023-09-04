<?php

namespace Tests\Feature;

use App\Livewire\Admin\Tutors;
use App\Livewire\Admin\Users;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TutorTest extends TestCase
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
        $role->givePermissionTo('tutor.*');

        Auth::login($this->user);

        $this->user->assignRole($role);
    }

    /**
     * @return void
     */
    public function test_index(): void
    {
        Livewire::test(Tutors::class)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_update(): void
    {
        Livewire::test(Users::class)
            ->call('makeTutor', $this->user)
            ->assertHasNoErrors()
            ->assertStatus(200);

        $tutor = Tutor::first();

        $image = UploadedFile::fake()->image('photo.png');

        Livewire::test(Tutors::class)
            ->call('update', $tutor->id)
            ->set('form.name', 'test')
            ->set('form.description', 'test')
            ->set('form.photo', $image)
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_search(): void
    {
        Livewire::test(Tutors::class)
            ->set('search', 'test')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }
}
