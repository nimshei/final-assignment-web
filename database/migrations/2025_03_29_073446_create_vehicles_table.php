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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->unique();
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('owner_nic');
            $table->string('owner_name');
            $table->string('owner_contact')->nullable();
            $table->string('chassis_number')->unique();
            $table->string('engine_number')->unique();
            $table->string('vehicle_type');
            $table->year('year_of_manufacture');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
