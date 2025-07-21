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
            $table->unsignedTinyInteger("status");
            $table->unsignedTinyInteger("finished_from_user")->default(0);
            $table->unsignedTinyInteger("finished_from_streamer")->default(0);
            $table->unsignedTinyInteger("day");
            $table->foreignId("user_id");
            $table->foreignId("streamer_id");
            $table->unsignedTinyInteger("review_point")->nullable();
            $table->foreignId("payment_id")->nullable();
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
