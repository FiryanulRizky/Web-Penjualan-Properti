<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('rumah_id')->nullable();
            $table->unsignedBigInteger('lahan_id')->nullable();
            $table->unsignedBigInteger('gedung_id')->nullable();
            $table->unsignedBigInteger('apartemen_id')->nullable();
            $table->unsignedBigInteger('gudang_id')->nullable();
            $table->unsignedBigInteger('offeredUser');
            $table->double('offerAmount');
            $table->timestamps();


            $table->foreign('property_id')
            ->references('id')
            ->on('properties')
            ->onDelete('cascade');

            $table->foreign('offeredUser')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('rumah_id')
            ->references('id')
            ->on('rumahs')
            ->onDelete('cascade');

            $table->foreign('lahan_id')
            ->references('id')
            ->on('lahans')
            ->onDelete('cascade');

            $table->foreign('gedung_id')
            ->references('id')
            ->on('gedungs')
            ->onDelete('cascade');

            $table->foreign('apartemen_id')
            ->references('id')
            ->on('apartemens')
            ->onDelete('cascade');

            $table->foreign('gudang_id')
            ->references('id')
            ->on('gudangs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
