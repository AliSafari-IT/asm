<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DisplayModelInstance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DisplayModelInstanceTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(DisplayModelInstance::class)
            ->assertStatus(200);
    }
}
