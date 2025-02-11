<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Envelope;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('envelopes', function (Blueprint $table) {
            // Step 1: Add user_id column as nullable
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->after('id');
        });

        // Step 2: Assign default user_id to existing rows (assuming first user exists)
        Envelope::whereNull('user_id')->update(['user_id' => User::first()?->id ?? 1]);

        // Step 3: Make user_id NOT NULL
        Schema::table('envelopes', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
