<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('envelopes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Name of the envelope (e.g., "Rent", "Groceries")
            $table->decimal('budgeted_amount', 10, 2); // Amount allocated
            $table->decimal('spent_amount', 10, 2)->default(0.00); // Amount spent
            $table->timestamps(); // Created_at and Updated_at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('envelopes');
    }
};
