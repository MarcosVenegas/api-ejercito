<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soldados', function (Blueprint $table) {
            $table->string('numeroPlaca', 25);
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('fechaNacimiento',8);
            $table->timestamps();
            $table->enum('rango',['soldado', 'sargento', 'capitán']);
            $table->enum('estado',['activo', 'retirado', 'baja']);

            $table->primary('numeroPlaca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soldados');
    }
}
