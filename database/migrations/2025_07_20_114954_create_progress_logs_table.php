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
        Schema::create('progress_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('goal_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('date');
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('body_fat_percentage', 5, 2)->nullable();
            $table->decimal('muscle_mass', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->json('photos')->nullable();
            $table->json('measurements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_logs');
    }
};
