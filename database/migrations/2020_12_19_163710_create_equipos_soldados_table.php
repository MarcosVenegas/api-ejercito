<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposSoldadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('equipos_soldados');
        Schema::create('equipos_soldados', function (Blueprint $table) {
            $table->id();

            $table->string("numeroPlaca",25);

            $table->foreign('numeroPlaca')->references('numeroPlaca')->on("soldados")->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('equipos_soldados');
    }
}
