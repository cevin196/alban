<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('serial_number');
            $table->integer('unit_kilometer');
            $table->date('date_in')->useCurrent();
            $table->date('date_out')->nullable();
            $table->string('customer_name');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('status', 20)->default('To Do');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
