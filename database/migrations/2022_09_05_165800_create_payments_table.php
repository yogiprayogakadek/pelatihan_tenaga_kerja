<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->startingValue(4720);
            // $table->foreignId('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreignId('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->integer('total');
            $table->date('payment_date');
            $table->json('payment_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
