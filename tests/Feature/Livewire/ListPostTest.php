<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Posts\ListPost;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPostTest extends TestCase
{
    use WithFaker;

    public function test_renders_successfully(): void
    {
        $user = User::factory()->create();

        $created = Post::factory()
            ->createMany([
                ['body' => $this->faker->sentence()],
                ['body' => $this->faker->sentence()],
            ]);

        $response = Livewire::actingAs($user)
            ->test(ListPost::class);

        $response->assertViewHas(
            'posts',
            fn (LengthAwarePaginator $posts) => $posts->count() === $created->count()
        );
        $response->assertViewIs('livewire.posts.list-post');
        $response->assertOk();
    }
}
