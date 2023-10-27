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
        Schema::create('ticket_response', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')
                ->constrained(
                    table: 'tickets'
                )
                ->cascadeOnDelete();
            $table->foreignId('response_by')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->timestamp('send_on')
                ->useCurrent();
            $table->boolean('is_seen')
                ->default(false);
            $table->enum('status', ['active', 'removed'])
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
        Schema::dropIfExists('ticket_response');
    }
};
