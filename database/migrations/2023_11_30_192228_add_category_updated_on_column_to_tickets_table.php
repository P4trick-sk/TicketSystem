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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->after('description')
                ->nullable()
                ->constrained(
                    table: 'categories'
                )
                ->cascadeOnDelete();
            $table->timestamp('updated_on')
                ->nullable()
                ->useCurrent()
                ->after('created_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('tickets_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropColumn('updated_on');
        });
    }
};
