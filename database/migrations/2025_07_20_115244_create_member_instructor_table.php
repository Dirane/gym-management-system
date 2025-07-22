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
        Schema::create('member_instructor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamps();
            
            $table->unique(['member_id', 'instructor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_instructor');
    }
};
