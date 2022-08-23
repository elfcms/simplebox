<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simplebox_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('data_type_id')->unsigned();
            $table->foreign('data_type_id')->references('id')->on('simplebox_data_types')->constrained()->onDelete('cascade');
            $table->text('value')->nullable();
            $table->bigInteger('value_int')->nullable();
            $table->float('value_float')->nullable();
            $table->date('value_date')->nullable();
            $table->dateTime('value_datetime')->nullable();
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
        Schema::dropIfExists('simplebox_options');
    }
};
