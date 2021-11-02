<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('zakat')->create('mal', function (Blueprint $table) {
        $table->id()->unsigned();
        $table->string('nama', 100);
        $table->string('jenis', 50);
        $table->json('data');
        $table->string('total');
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
        Schema::connection('zakat')->dropIfExists('mal');
    }
}
