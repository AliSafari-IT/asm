<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // createIfDoesNotExists
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('password_reset_tokens')) {

            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (!Schema::hasTable('failed_jobs')) {

            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('personal_access_tokens')) {

            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->morphs('tokenable');
                $table->string('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('description')->nullable();
                // add slug field to the roles table and make it optional and unique
                $table->string('slug')->unique()->nullable();
                $table->timestamps();
            });

        }

        if (!Schema::hasTable('permissions')) {

            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('slug')->unique()->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('role_user')) {

            Schema::create('role_user', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id');
                $table->unsignedBigInteger('user_id');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->primary(['role_id', 'user_id']); // Composite primary key
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->primary(['permission_id', 'role_id']); // Composite primary key
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('title');
                $table->longText('body');
                $table->string('image')->nullable();
                $table->enum('status', ['draft', 'published', 'deleted', 'archived'])->default('draft');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id(); // Unique identifier for each tag
                $table->string('name', 191)->unique(); // The name of the tag, unique
                $table->string('slug', 191)->unique(); // A URL-friendly version of the tag name, unique
                $table->string('description', 999)->nullable(); // A description of the tag
                $table->timestamps(); // Timestamps to track when tags are created or updated
            });
        }

        if (!Schema::hasTable('articles_tags')) {
            Schema::create('articles_tags', function (Blueprint $table) {
                $table->foreignId('article_id')->constrained()->onDelete('cascade');
                // Creates a foreign key column `article_id` that references the `id` column in the `articles` table.
                // `onDelete('cascade')` means if an article is deleted, the related records in `article_tag` are also deleted.

                $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
                // Similar to `article_id`, creates a foreign key column `tag_id` that references the `id` column in the `tags` table.
                // `onDelete('cascade')` ensures that if a tag is deleted, its associations with articles are also removed.

                $table->primary(['article_id', 'tag_id']); // Sets a composite primary key on the combination of `article_id` and `tag_id`.

                $table->timestamps(); // Adds `created_at` and `updated_at` columns to track when each association was created or last updated.
            });
        }
        if (!Schema::hasTable('posts_tags')) {
            Schema::create('posts_tags', function (Blueprint $table) {
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
                // Creates a foreign key column `post_id` that references the `id` column in the `posts` table.
                // `onDelete('cascade')` ensures that if a post is deleted, its associated tags in `post_tag` are also removed.

                $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
                // Creates a foreign key column `tag_id` that references the `id` column in the `tags` table.
                // `onDelete('cascade')` ensures that if a tag is deleted, its associations with posts are also removed.

                $table->primary(['post_id', 'tag_id']); // Sets a composite primary key on the combination of `post_id` and `tag_id`.

                $table->timestamps(); // Optionally adds `created_at` and `updated_at` columns.
            });
        }

        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique()->nullable();
                $table->string('description')->nullable();

                $table->timestamps();
            });
        }

        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->text('body'); // The comment text
                $table->unsignedBigInteger('parent_id')->nullable(); // For nested comments
                $table->unsignedBigInteger('commentable_id'); // The ID of the article or post
                $table->string('commentable_type'); // Distinguishes between articles and posts
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming comments are made by users
                $table->timestamps();

                // Foreign key constraint for the self-referencing 'parent_id' to support nested comments.
                $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key');
                $table->string('value');
                $table->timestamps();

                $table->index(['key', 'deleted_at']); // Optimize for queries filtering by 'key' and optionally 'deleted_at'
                // Consider other indexes based on actual query patterns
            });
        }

        if (!Schema::hasTable('model_instances')) {
            Schema::create('model_instances', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('application')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('articles')) {

            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');

                $table->string('slug')->unique(); // Ensure slugs are unique
                $table->json('images')->nullable(); // Store images as a JSON string
                $table->json('keywords')->nullable(); // Store keywords as a JSON string
                $table->longText('body'); // Suitable for storing large HTML or rich text content
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
                $table->enum('docType', ['news', 'article', 'event', 'project', 'tutorial', 'report', 'technical_report', 'paper', 'conference_paper', 'book', 'technical_book', 'research_paper', 'other'])->default('news');
                $table->timestamp('published_at')->nullable();
                $table->boolean('is_published')->default(false);
                $table->boolean('is_public')->default(false);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('images')) {

            Schema::create('images', function (Blueprint $table) {
                $table->id(); // Unique identifier for each image
                $table->string('source'); // The source of the image (e.g., "internal", "external", specific website or platform)
                $table->string('type', 50); // The type of the image (e.g., "jpeg", "png", "svg")
                $table->string('path'); // The path or URL to the image
                $table->string('alt_text')->nullable(); // Alternative text for the image, for accessibility
                $table->string('dimensions')->nullable(); // The dimensions of the image (e.g., "1920x1080")
                $table->text('caption')->nullable(); // A brief description of the image
                $table->timestamps(); // Timestamps to track when the image record was created or updated

                // You might want to add indexes on columns frequently used in queries or filters, such as 'source' or 'type'
                $table->index('source');
                $table->index('type');
            });
        }

        if (!Schema::hasTable('keywords')) {
            Schema::create('keywords', function (Blueprint $table) {
                $table->id();
                $table->string('keyword')->unique();
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('articles_keywords')) {
            Schema::create('articles_keywords', function (Blueprint $table) {
                $table->id();
                $table->foreignId('article_id')->constrained()->onDelete('cascade');
                $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
        
        if (!Schema::hasTable('articles_users')) {            
            Schema::create('articles_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('article_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('posts_keywords')) {
            Schema::create('posts_keywords', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
                $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });            
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'users',
            'password_reset_tokens',
            'failed_jobs',
            'personal_access_tokens',
            'model_instances',
            'categories',
            'comments',
            'settings',
            'articles',
            'images',
            'tags',
            'posts',
            'roles',
            'posts_tags',
            'articles_tags',
            'posts_comments',
            'articles_comments',
            'posts_images',
            'articles_images',
            'articles_keywords',
            'posts_keywords',
            'articles_users',
            'posts_users'

        );

    }
};
