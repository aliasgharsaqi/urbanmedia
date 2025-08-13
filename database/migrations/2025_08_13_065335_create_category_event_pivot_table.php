<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_category_event_pivot_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_event', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->primary(['category_id', 'event_id']);
        });
    }

    public function down() { Schema::dropIfExists('category_event'); }
};
