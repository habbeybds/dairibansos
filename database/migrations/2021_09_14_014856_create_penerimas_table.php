<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('no_skid');
            $table->foreignId('nik');
            $table->string('no_kk');
            $table->string('name');
            $table->string('alamat',255);
            $table->foreignId("desaid");
            $table->enum('jenis_kelamin', ['-','L', 'P'])->default('-');
            $table->string("pekerjaan");
            $table->enum('status_kawin', ['-','kawin', 'belum kawin','cerai mati'])->default('-');
            $table->string('dtks')->nullable();
            $table->string('dtks2_kk')->nullable();
            $table->foreignId('jenisbantuanid');
            $table->float('nominal_bantuan', 13, 2);
            $table->string('no_hp')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('penerimas');
    }
}
