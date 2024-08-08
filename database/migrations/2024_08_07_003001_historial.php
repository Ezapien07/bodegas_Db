<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->id('idHistorial');
            $table->integer('cantidad');
            $table->integer('movimiento');
            $table->dateTime('fechaMov');
            $table->unsignedBigInteger('idProducto');
            $table->unsignedBigInteger('idUserMov');
            $table->foreign('idProducto')->references('idProducto')->on('Productos');
            $table->foreign('idUserMov')->references('idUsuario')->on('Usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
