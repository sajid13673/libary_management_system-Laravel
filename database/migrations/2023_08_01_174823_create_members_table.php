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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(50)->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('address')->nullable(false);
            $table->integer('phone_number')->length(10)->nullable(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
