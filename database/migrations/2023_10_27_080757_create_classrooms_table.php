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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->json('seats')
                ->nullable();
            $table->foreignId('managed_by')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->timestamp('created_on')
                ->useCurrent();
            $table->timestamp('updated_on')
                ->useCurrent();
            $table->enum('status', ['active', 'disabled'])
                ->default('active');
            $table->string('comment', 255)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
