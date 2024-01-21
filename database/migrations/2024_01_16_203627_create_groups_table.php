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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)
                ->unique();
            $table->string('description', 255)
                ->nullable();
            $table->foreignId('created_by')
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
        Schema::dropIfExists('groups');
    }
};
