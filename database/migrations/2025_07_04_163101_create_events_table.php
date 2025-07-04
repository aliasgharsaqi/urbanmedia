<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('email');
            $table->date('date');
            $table->time('time');
            $table->decimal('rate', 8, 2);
            $table->string('heading');
            $table->string('address');
            $table->text('others')->nullable();
            $table->string('entry');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
