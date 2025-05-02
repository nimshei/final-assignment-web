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
        Schema::create('offences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('officer_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('violation_id');
            $table->dateTime('date_time');
            $table->string('location');
            $table->text('description')->nullable();
            $table->decimal('fine_amount', 10, 2);
            $table->dateTime('court_date')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->enum('status', ['Pending', 'Warning', 'Paid', 'Court'])->default('Pending');
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('violation_id')->references('id')->on('violations')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offences');
    }
};
