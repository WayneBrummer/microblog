<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Laravel\Jetstream\Features;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_tokens_can_be_created(): void
    {
        if (!Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(ApiTokenManager::class)
            ->set(['createApiTokenForm' => [
                'name' => 'Test Token',
                'permissions' => [
                    'read',
                    'update',
                ],
            ]])
            ->call('createApiToken');

        $this->assertCount(1, $user->fresh()->tokens);
        $this->assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        $this->assertTrue($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('delete'));
    }
}
