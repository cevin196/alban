<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->smallInteger('weight')->default(3);
            $table->string('unit', 100);
            $table->text('description')->nullable();
            $table->boolean('type')->default('1');
            $table->boolean('deletable')->default('1');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criterias');
    }
};
