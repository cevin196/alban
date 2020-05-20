<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_bahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama',200);
            $table->string('referensi',200);
            $table->integer('price');
            $table->integer('qty');
            $table->string('no_nota',200);
            $table->foreign('no_nota')->references('no_nota')->on('notas')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('part_bahans');
    }
}
