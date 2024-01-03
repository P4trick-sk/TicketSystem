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
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign('classrooms_room_manager_foreign');
            $table->dropForeign('classrooms_technical_manager_foreign');
            $table->dropColumn('room_manager');
            $table->dropColumn('technical_manager');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('room_manager')
                ->after('seats')
                ->nullable()
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->foreignId('technical_manager')
                ->after('room_manager')
                ->nullable()
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
        });
    }
};
