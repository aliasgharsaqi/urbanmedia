<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // For the "Subscribe to newsletter" checkbox
            $table->boolean('subscribed_to_newsletter')->nullable()->default(false)->after('remember_token');
            
            // For the "I agree to the Terms & Conditions" checkbox
            $table->timestamp('terms_accepted_at')->nullable()->after('subscribed_to_newsletter');
            
            // For the "I accept the Privacy Policy" checkbox
            $table->timestamp('privacy_policy_accepted_at')->nullable()->after('terms_accepted_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['subscribed_to_newsletter', 'terms_accepted_at', 'privacy_policy_accepted_at']);
        });
    }
};