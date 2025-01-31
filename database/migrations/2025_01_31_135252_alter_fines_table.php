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
        Schema::table('fines', function (Blueprint $table) {
            $table->dropColumn(['paid_date', 'type']);
            $table->string('amount')->nullable(false)->change();
            $table->boolean('paid')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fines', function (Blueprint $table) {
            //
        });
    }
};
