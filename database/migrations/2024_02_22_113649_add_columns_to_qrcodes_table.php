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
        Schema::table('qrcode', function (Blueprint $table) {
            $table->unsignedBigInteger('Order_Id')->nullable();
            $table->foreign('Order_Id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qrcode', function (Blueprint $table) {
            Schema::dropIfExists('qrcode');
        });
    }
};
