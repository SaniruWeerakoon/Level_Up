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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();;
            $table->text('description');
            $table->string('subject');
            $table->string('difficulty');
            $table->decimal('price', 8, 2);

            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('type');
            $table->text('content');
            $table->string('estimated_length');
            $table->string('course_image_path')->nullable();
            $table->tinyInteger('ratings')->nullable();
            $table->integer('completed_by')->nullable();
            $table->boolean('hidden')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
