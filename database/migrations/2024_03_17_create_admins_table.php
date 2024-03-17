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
        Schema::create('role_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // Assuming each admin role might have a unique email
            $table->text('description')->nullable(); // Optional description for the role

            $table->softDeletes(); // Enable soft deletes
            $table->timestamps(); // Created at and updated at timestamps

            // Define a foreign key that references the 'id' column of the 'users' table
            // This assumes that each admin role is associated with a user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_admins');
    }
};
