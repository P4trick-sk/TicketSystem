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
        Schema::create('classroom_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')
                ->constrained(
                    table: 'classrooms'
                )
                ->cascadeOnDelete();
            $table->foreignId('category_type_id')
                ->constrained(
                    table: 'category_types'
                )
                ->cascadeOnDelete();
            $table->foreignId('assigned_to')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->timestamp('created_on')
                ->useCurrent();
            $table->timestamp('updated_on')
                ->useCurrent();
            $table->enum('status', ['active', 'banned', 'deleted'])
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
        Schema::dropIfExists('classroom_managers');
    }
};
