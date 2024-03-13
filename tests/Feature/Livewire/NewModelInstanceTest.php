<?php

namespace Tests\Feature\Livewire;

use App\Livewire\NewModelInstance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NewModelInstanceTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(NewModelInstance::class)
            ->assertStatus(200);
    }
}
