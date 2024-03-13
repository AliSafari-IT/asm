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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->softDeletes();
            $table->boolean('is_default')->default(0);
            $table->boolean('is_system')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_public')->default(0);
            $table->boolean('is_disabled')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_visible')->default(1);
            $table->boolean('is_readonly')->default(0);
            $table->boolean('is_protected')->default(0);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_unique')->default(1);
            $table->boolean('is_searchable')->default(1);
            $table->boolean('is_sortable')->default(1);
            $table->boolean('is_filterable')->default(1);
            $table->boolean('is_pinned')->default(0);
            $table->boolean('is_movable')->default(1);
            $table->boolean('is_copyable')->default(1);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
