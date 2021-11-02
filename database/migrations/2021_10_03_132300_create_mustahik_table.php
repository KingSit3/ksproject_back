<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMustahikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mustahik', function (Blueprint $table) {
        $table->id()->unsigned();
        $table->string('nama_keluarga', 100);
        $table->integer('rt')->unsigned();
        $table->integer('rw')->unsigned();
        $table->string('jumlah_anggota_keluarga');
        $table->softDeletes();
        $table->timestamp('created_at')->useCurrent()->nullable();
        $table->timestamp('updated_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mustahik');
    }
}
