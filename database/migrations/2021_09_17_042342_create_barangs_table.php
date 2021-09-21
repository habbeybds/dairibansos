<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agen_id');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->enum('satuan', ['kg', 'pcs', 'box', 'bks', 'ltr', 'lusin'])->default('pcs');
            $table->float('harga', 13, 2);
            $table->string('stok',8);
            $table->enum('status', ['pending', 'cancelled', 'approved'])->default('approved');
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
        Schema::dropIfExists('barangs');
    }
}
