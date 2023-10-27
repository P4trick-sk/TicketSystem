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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)
                ->unique();
            $table->timestamp('email_verified_at')
                ->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->enum('role', ['student', 'teacher', 'admin'])
                ->default('student');
            $table->timestamp('created_on')
                ->useCurrent();
            $table->timestamp('updated_on')
                ->useCurrent();
            $table->timestamp('logged_at')
                ->useCurrent();
            $table->string('reg_ip', 255);
            $table->string('last_ip', 255);
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
        Schema::dropIfExists('users');
    }
};
