<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(10)->create();

        $firstPost = Post::first();
        if ($firstPost) {
            $firstPost->update([
                'slug' => 'first-post'
            ]);
        }
    }
}

