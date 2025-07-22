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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'active', 'expired', 'suspended', 'cancelled'])->default('pending');
            $table->decimal('registration_fee', 10, 2)->default(5000.00);
            $table->decimal('monthly_fee', 10, 2)->default(10000.00);
            $table->decimal('discount_applied', 10, 2)->default(0.00);
            $table->string('card_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
