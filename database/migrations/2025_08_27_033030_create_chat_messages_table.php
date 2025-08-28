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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->foreignId('ticket_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('agent_id')->nullable()->constrained('agents')->onDelete('cascade');
            $table->text('message');
            $table->enum('message_type', ['Text', 'Image', 'File', 'Link'])->default('Text');
            $table->enum('sender_type', ['Customer', 'AI Bot', 'Agent']);
            $table->decimal('ai_confidence_score', 3, 2)->nullable();
            $table->string('intent_classification')->nullable();
            $table->decimal('sentiment_score', 3, 2)->nullable();
            $table->string('language_detected', 10)->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
