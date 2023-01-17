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
        Schema::create('developers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nivel')->unsigned();
            $table->foreign('nivel')->references('id')->on('levels');
                        
            $table->char('nome', 255);
            $table->char('sexo', 1);
            $table->date('datanascimento');
            $table->integer('idade');
            $table->char('hobby', 255);

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
        Schema::dropIfExists('developers');
    }
};
