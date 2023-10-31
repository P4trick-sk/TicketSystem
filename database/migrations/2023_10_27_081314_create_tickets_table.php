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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->string('subject', 255);
            $table->text('description');
            $table->text('summary')
                ->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])
                ->default('low');
            $table->foreignId('classroom_id')
                ->nullable()
                ->constrained();
            $table->timestamp('created_on')
                ->useCurrent();
            $table->timestamp('clossed_on')
                ->nullable()
                ->default(null);
            $table->enum('status', ['created', 'assigned', 'waiting_for_teacher', 'waiting_for_student', 'closed'])
                ->default('created');
            $table->string('comment', 255)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
