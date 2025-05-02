<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('license_number')->unique();
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('id_type');
            $table->string('id_number');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->enum('sex', ['Male', 'Female']);
            $table->text('permanent_address');
            $table->string('phone_number');
            $table->string('divisional_secretariat_code', 4);
            $table->string('blood_group');
            $table->boolean('organ_donor_status');
            $table->string('height');
            $table->boolean('active_status')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses');
    }
};
