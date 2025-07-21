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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("order_id");
            $table->unsignedInteger("service_payment_id")->nullable();
            $table->unsignedInteger("amount_value")->nullable();
            $table->string("status")->nullable();
            $table->boolean("paid")->default(false);
            $table->string("expires_at")->nullable();
            $table->boolean("test")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
