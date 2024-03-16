<?php

namespace Tests\Feature\Livewire;

use App\Livewire\PermissionsTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PermissionsTableTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PermissionsTable::class)
            ->assertStatus(200);
    }
}
