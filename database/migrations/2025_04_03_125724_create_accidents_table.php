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
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('officer_id');
            $table->dateTime('accident_date_time');
            $table->string('location');
            $table->text('description')->nullable();
            $table->enum('severity', ['Minor', 'Moderate', 'Severe', 'Fatal'])->default('Minor');
            $table->integer('injuries')->default(0);
            $table->integer('fatalities')->default(0);
            $table->decimal('property_damage')->default(0);
            $table->enum('status', ['Pending', 'Investigating', 'Resolved', 'Closed'])->default('Pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};
