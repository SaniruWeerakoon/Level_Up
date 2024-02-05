<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role_id')->default(3);

            $table->string('profile_image_path')->nullable();
            $table->string('mobile')->nullable();
            $table->string('designation')->nullable();
            $table->string('skill_level')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('progress')->default(0);

            $table->timestamp('last_login')->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
