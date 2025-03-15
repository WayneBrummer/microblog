<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Posts\CreatePost;

class CreatePostTest extends TestCase
{
    public function test_it_cannot_create_a_post_for_unauthorised_users(): void
    {
        $action = Livewire::test(CreatePost::class);
        $action->assertUnauthorized();
    }

    public function test_it_can_create_a_post_for_authorised_users(): void
    {
        $user = User::factory()->create();

        $action = Livewire::actingAs($user)
            ->test(CreatePost::class, ['body' => 'Test Post']);

        $action->call('save');

        $action->assertSuccessful();
        $this->assertDatabaseHas('posts', ['body' => 'Test Post']);
    }
}
