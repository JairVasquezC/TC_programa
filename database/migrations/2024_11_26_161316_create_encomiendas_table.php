<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('encomiendas', function (Blueprint $table) {
            $table->id();
            $table->decimal('costo_total', 10, 2)->default(0);
            $table->string('estado_envio', 15)->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->foreignId('id_remitente')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('id_destinatario')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('id_viaje')->nullable()->constrained('viajes')->onDelete('set null');
            $table->foreignId('id_empresa')->nullable()->constrained('clientes')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('encomiendas');
    }
};
