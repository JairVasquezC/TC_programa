<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nullable();
            $table->decimal('dimension_ancho', 5, 2)->nullable();
            $table->decimal('dimension_largo', 5, 2)->nullable();
            $table->decimal('dimension_grosor', 5, 2)->nullable();
            $table->decimal('peso', 10, 2);
            $table->decimal('costo', 10, 2);
            $table->foreignId('id_encomienda')->constrained('encomiendas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paquetes');
    }
};
