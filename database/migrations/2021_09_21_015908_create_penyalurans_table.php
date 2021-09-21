<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePenyaluransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id');
            $table->string('nik')->unique();
            $table->string('barang');
            $table->string('img')->nullable();
            $table->dateTime('tgl_penyaluran');
            $table->enum('status', ['completed','pending'])->default('pending');
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
        Schema::dropIfExists('penyalurans');
    }
}
