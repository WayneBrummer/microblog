<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Posts\ListPost;

class ListPostTest extends TestCase
{
    public function test_renders_successfully(): void
    {
        Livewire::test(ListPost::class)
            ->assertStatus(200);
    }
}
