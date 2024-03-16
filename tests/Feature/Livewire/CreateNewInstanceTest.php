<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateNewInstance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateNewInstanceTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CreateNewInstance::class)
            ->assertStatus(200);
    }
}
