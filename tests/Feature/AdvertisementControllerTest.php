<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Bid;
use Tests\TestCase;

class AdvertisementControllerTest extends TestCase
{
    use RefreshDatabase; //, WithoutMiddleware;

    public function test_index()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('advertisements.index'));

        $response->assertStatus(200);
        $response->assertViewIs('advertisements.advertisements');
        $response->assertViewHas('advertisements');
    }

    public function test_show_by_slug_displays_advertisement()
    {
        $user = User::factory()->create();

        $advertisement = Advertisement::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('advertisements.showBySlug', $advertisement->slug));

        $response->assertStatus(200);
        $response->assertViewIs('advertisements.advertisement');
        $response->assertViewHas('advertisement', function ($viewAdvertisement) use ($advertisement) {
            return $viewAdvertisement->id === $advertisement->id;
        });
    }

    public function test_create_page_displays_correctly()
    {
        Role::create(['name' => 'particulier']);
        $user = User::factory()->create();

        $user->assignRole('particulier');

        $this->assertTrue($user->hasRole('particulier'));

        Category::factory()->count(5)->create();


        $this->actingAs($user);

        $response = $this->get(route('advertisements.create'));

        $response->assertStatus(200);

        $response->assertViewIs('advertisements.create_advertisement');

        $response->assertViewHas('categories');

        $response->assertViewHas('categories', function ($viewCategories) {
            return count($viewCategories) === 5;
        });
    }


    public function test_user_is_able_to_make_advertisement()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('advertentie.jpg');

        $data = [
            'user_id' => $user->id,
            'title' => 'Test Advertentie',
            'description' => 'Dit is een test beschrijving',
            'slug' => 'test-advertentie',
            'excerpt' => 'Test excerpt',
            'image' => $image,
            'category' => $category->id,
            'duration' => 7,
        ];

        $response = $this->post(route('advertisements.store'), $data);

        $response->assertRedirect(route('my-advertisements'));

        $this->assertDatabaseHas('advertisements', [
            'title' => 'Test Advertentie',
            'description' => 'Dit is een test beschrijving',
            'slug' => 'test-advertentie',
            'excerpt' => 'Test excerpt',
            'category_id' => $category->id,
        ]);
    }

    

}
