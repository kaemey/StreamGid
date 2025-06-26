<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("description");
            $table->tinyInteger("status");
            $table->tinyInteger("finished_from_user")->default(0);
            $table->tinyInteger("finished_from_streamer")->default(0);
            $table->tinyInteger("day");
            $table->foreignId("user_id");
            $table->foreignId("streamer_id");
            $table->smallInteger("payment_status")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};