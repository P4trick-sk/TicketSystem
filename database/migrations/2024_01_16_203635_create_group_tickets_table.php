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
        Schema::create('group_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained(
                    table: 'groups'
                )
                ->cascadeOnDelete();
            $table->foreignId('ticket_id')
                ->constrained(
                    table: 'tickets'
                )
                ->cascadeOnDelete();
            $table->foreignId('assigned_by')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->dateTime('created_on')
                ->useCurrent();
            $table->dateTime('updated_on')
                ->useCurrent();
            $table->softDeletes();
            $table->string('comment', 255)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_tickets');
    }
};
