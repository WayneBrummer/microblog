<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Profiles\ListPost;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileListPostTest extends TestCase
{
    use WithFaker;

    public function test_it_cannot_render_a_post_list_for_unauthorised_users(): void
    {
        $action = Livewire::test(ListPost::class);
        $action->assertUnauthorized();
    }

    public function test_it_shows_only_the_mounted_user(): void
    {

        $userView = User::factory()->create();
        $user = User::factory()->create();

        $created = Post::factory()
            ->for($user)
            ->createMany([
                ['body' => $this->faker->sentence()],
                ['body' => $this->faker->sentence()],
            ]);

        Post::factory()
            ->for($userView)
            ->createMany([
                ['body' => $this->faker->sentence()],
                ['body' => $this->faker->sentence()],
                ['body' => $this->faker->sentence()],
            ]);

        $response = Livewire::actingAs($userView)
            ->test(ListPost::class, ['user' => $user]);

        $response->assertViewHas('posts', function (LengthAwarePaginator $posts) use ($created) {
            return $posts->count() === $created->count();
        });
        $response->assertViewIs('livewire.profiles.list-post');
        $response->assertOk();

    }
}
