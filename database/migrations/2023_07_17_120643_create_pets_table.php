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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('qr_id');
            $table->foreign('qr_id')->references('id')->on('qrcode');
            $table->string('pet_name');
            $table->date('pet_age')->nullable();
            $table->string('gender');
            $table->string('profile')->nullable();
            $table->string('breed')->nullable();
            $table->text('special_instruction')->nullable();
            $table->string('status')->default('inactive');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
