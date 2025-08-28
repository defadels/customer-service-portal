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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('department')->nullable();
            $table->enum('role', ['Junior Agent', 'Senior Agent', 'Supervisor', 'Manager']);
            $table->text('skills')->nullable();
            $table->text('languages')->nullable();
            $table->text('shift_schedule')->nullable();
            $table->foreignId('supervisor_id')->nullable()->constrained('agents')->onDelete('set null');
            $table->enum('status', ['Active', 'On Leave', 'Terminated'])->default('Active');
            $table->date('hire_date')->nullable();
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['Low', 'Medium', 'High', 'Urgent', 'Critical'])->default('Medium');
            $table->enum('status', ['Open', 'In Progress', 'Pending', 'Resolved', 'Closed'])->default('Open');
            $table->string('category')->nullable();
            $table->string('subcategory')->nullable();
            $table->foreignId('assigned_agent_id')->nullable()->constrained('agents')->onDelete('set null');
            $table->enum('source', ['Chat', 'Email', 'Phone', 'Social Media'])->default('Chat');
            $table->integer('escalation_level')->default(0);
            $table->datetime('sla_deadline')->nullable();
            $table->datetime('resolved_at')->nullable();
            $table->decimal('sentiment_score', 3, 2)->nullable();
            $table->string('ai_category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
        Schema::dropIfExists('tickets');
    }
};
