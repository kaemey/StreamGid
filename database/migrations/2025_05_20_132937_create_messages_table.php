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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id'); // Ссылка на чат
            $table->unsignedBigInteger('from_id');  // Кто отправил
            $table->unsignedBigInteger('to_id');  // Кому отправили
            $table->text('text');                  // Текст сообщения
            $table->timestamps();

            // Связь с чатом
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');

            // Кто отправил
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};