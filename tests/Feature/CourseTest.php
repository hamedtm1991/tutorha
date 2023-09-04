<?php

namespace Tests\Feature;

use App\Livewire\Admin\Courses;
use App\Livewire\Admin\Users;
use App\Models\Product;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Tutor $tutor;

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
        $role->givePermissionTo('product.*');
        $role->givePermissionTo('user.*');

        Auth::login($this->user);

        $this->user->assignRole($role);

        Product::factory(2)->create();

        Livewire::test(Users::class)
            ->call('makeTutor', $this->user)
            ->assertHasNoErrors()
            ->assertStatus(200);

        $this->tutor = Tutor::first();
    }

    /**
     * @return void
     */
    public function test_index(): void
    {
        Livewire::test(Courses::class)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_create(): void
    {
        $image = UploadedFile::fake()->image('photo.png');

        Livewire::test(Courses::class)
            ->call('create')
            ->set('form.title', 'test')
            ->set('form.ckeditor1', 'test')
            ->set('form.ckeditor2', 'test')
            ->set('form.price', '1000')
            ->set('form.time', '1')
            ->set('form.numberOfEpisodes', '5')
            ->set('form.tutors', [$this->tutor->id => ''])
            ->set('form.level', Product::LEVEL_ADVANCED)
            ->set('form.photo', $image)
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_update(): void
    {
        $product = Product::first();

        Livewire::test(Courses::class)
            ->call('update', $product->id)
            ->set('form.title', 'test2')
            ->set('form.ckeditor1', 'test')
            ->set('form.ckeditor2', 'test')
            ->set('form.time', '1')
            ->set('form.numberOfEpisodes', '5')
            ->set('form.tutors', [$this->tutor->id => ''])
            ->set('form.level', Product::LEVEL_ADVANCED)
            ->call('save')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_delete(): void
    {
        $product = Product::first();

        Livewire::test(Courses::class)
            ->call('delete', 'Product-' . $product->id)
            ->assertHasNoErrors()
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_search(): void
    {
        Livewire::test(Courses::class)
            ->set('search', 'test')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }
}
