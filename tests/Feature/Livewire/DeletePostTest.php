<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Posts\DeletePost;
use Illuminate\Foundation\Testing\WithFaker;

class DeletePostTest extends TestCase
{
    use WithFaker;

    public function test_it_can_delete_a_post(): void
    {
        $user = User::factory()->create();

        $post = Post::factory()
            ->for($user)
            ->create(['body' => $this->faker->sentence()]);

        $action = Livewire::actingAs($user)
            ->test(DeletePost::class, ['postId' => $post->id]);

        $action->call('delete');

        $action->assertSuccessful();
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_it_cannot_delete_another_users_post(): void
    {
        $user = User::factory()->create();
        $userExternal = User::factory()->create();

        $post = Post::factory()
            ->for($user)
            ->create(['body' => $this->faker->sentence()]);

        $action = Livewire::actingAs($userExternal)
            ->test(DeletePost::class, ['postId' => $post->id]);

        $action->call('delete');
        $action->assertForbidden();
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function tests_a_guest_cannot_delete_the_tests(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();
        $action = Livewire::test(DeletePost::class, ['postId' => $post->id]);

        $action->call('delete');
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }
}
