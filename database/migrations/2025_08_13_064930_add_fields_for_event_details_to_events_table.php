<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // These fields are required based on the reference form.
            $table->date('end_date')->after('time');
            $table->time('end_time')->after('end_date');

            // This can have a default value.
            $table->string('occurrence_type')->default('once')->after('end_time');

            $table->string('event_access_type')->default('paid')->after('occurrence_type');
            // These fields are optional.
            $table->string('youtube_url')->nullable()->after('desc');
            $table->string('special_details')->nullable()->after('youtube_url');
            $table->string('status')->default('draft')->after('special_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'end_date',
                'end_time',
                'occurrence_type',
                'event_access_type',
                'youtube_url',
                'special_details',
                'status',
            ]);
        });
    }
};
