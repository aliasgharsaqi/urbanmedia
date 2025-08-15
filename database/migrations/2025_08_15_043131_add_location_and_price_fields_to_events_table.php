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
        Schema::table('events', function (Blueprint $table) {
            // Adding new nullable columns for location, price, and terms
            $table->string('venue')->nullable()->after('heading');
            $table->string('city')->nullable()->after('venue');
            $table->decimal('price', 8, 2)->nullable()->after('entry');
            $table->text('terms_and_conditions')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['venue', 'city', 'price', 'terms_and_conditions']);
        });
    }
};
