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
        Schema::create('detail_redeems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_redeem');
            $table->foreign('id_redeem')->references('id')->on('riwayat_redeems');
            $table->string('produk');
            $table->integer('jumlah');
            $table->integer('poin');
            $table->integer('total');
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
        Schema::dropIfExists('detail_redeems');
    }
};
