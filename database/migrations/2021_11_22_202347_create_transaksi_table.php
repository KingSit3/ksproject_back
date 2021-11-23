<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('zakat')->create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mustahik_id')->constrained('mustahik');
            $table->string('jenis_zakat');
            $table->string('jumlah');
            $table->string('status')->comment('0.Berlangsung 1.Sukses');
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
        Schema::connection('zakat')->dropIfExists('transaksi');
    }
}
