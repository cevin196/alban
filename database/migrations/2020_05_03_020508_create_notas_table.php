<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->string('no_nota', 25)->primary();
            $table->string('kota',100);
            $table->date('tanggal');
            $table->string('kepada', 25)->nullable();
            $table->string('attn', 25);
            $table->string('make', 25);
            $table->string('unit_plat_number', 25);
            $table->integer('unit_kilometer');
            $table->integer('total');
            $table->integer('potongan');
            $table->string('rekening',25);
            $table->string('bank', 100);
            $table->string('atas_nama', 25);
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
        Schema::dropIfExists('notas');
    }
}
