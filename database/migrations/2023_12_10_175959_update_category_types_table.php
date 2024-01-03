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
        Schema::table('category_types', function (Blueprint $table) {
            $table->foreignId('assigned_to')
                ->after('name')
                ->nullable()
                ->constrained(
                    table: 'users'
                )
                ->cascadeOnDelete();
            $table->boolean('is_dynamic')
                ->after('assigned_to')
                ->default(false);
            $table->softDeletes()
                ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_types', function (Blueprint $table) {
            $table->dropForeign('category_types_assigned_to_foreign');
            $table->dropColumn('assigned_to');
            $table->dropColumn('is_dynamic');
            $table->dropSoftDeletes();
        });
    }
};
