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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'agent', 'supervisor'])->default('agent')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('department')->nullable()->after('phone');
            $table->text('skills')->nullable()->after('department');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('skills');
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('set null')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['supervisor_id']);
            $table->dropColumn(['role', 'phone', 'department', 'skills', 'status', 'supervisor_id']);
        });
    }
};
