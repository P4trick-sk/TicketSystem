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
            $table->dropForeign('classrooms_managed_by_foreign');
            $table->dropColumn('managed_by');
            $table->foreignId('room_manager')
                ->after('seats')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->foreignId('technical_manager')
                ->after('room_manager')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('managed_by')
                ->after('seats')
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->dropForeign('classrooms_room_manager_foreign');
            $table->dropForeign('classrooms_technical_manager_foreign');
            $table->dropColumn('room_manager');
            $table->dropColumn('technical_manager');
        });
    }
};
