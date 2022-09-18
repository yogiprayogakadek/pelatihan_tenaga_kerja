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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->boolean('gender');
            $table->char('phone', 16);
            $table->string('address', 100);
            $table->json('documents')->nullable();
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
        Schema::dropIfExists('participants');
    }
};
