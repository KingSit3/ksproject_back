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
      Schema::connection('zakat')->create('mustahik', function (Blueprint $table) {
        $table->id();
        $table->string('nama_keluarga', 100);
        $table->string('alamat');
        $table->string('rt');
        $table->string('rw');
        $table->string('kelurahan');
        $table->string('kecamatan');
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
      // Delete table with foreign key first
      Schema::connection('zakat')->dropIfExists('transaksi');
      // Delete this table
      Schema::connection('zakat')->dropIfExists('mustahik');
    }
}
