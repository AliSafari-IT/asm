<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(PostsTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);

        $this->call(UsersTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);

        $this->call(RolesTableSeeder::class);

        $this->call(SettingTableSeeder::class);

        $this->call(UsersTableSeeder::class);

        $this->call(CommentsTableSeeder::class);

        $this->call(RepliesTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(TagsTableSeeder::class);
    }
}
