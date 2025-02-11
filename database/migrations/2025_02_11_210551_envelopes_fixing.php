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
        Schema::table('envelopes', function (Blueprint $table) {
            // $table->string('title')->nullable(); // Name of the envelope (e.g., "Rent", "Groceries")
            $table->string('notes')->nullable();
            $table->decimal('goal', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->default(0.00)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
