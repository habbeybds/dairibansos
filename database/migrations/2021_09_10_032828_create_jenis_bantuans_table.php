<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisBantuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_bantuans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bantuan')->unique();
            $table->string('jumlah_tahapan');
            $table->string('tahun_tahapan');
            $table->enum('status', ['actived', 'cancelled'])->default('actived');
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
        Schema::dropIfExists('jenis_bantuans');
    }
}
