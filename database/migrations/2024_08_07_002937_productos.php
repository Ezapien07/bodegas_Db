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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idProducto');
            $table->string('nombre')->unique();
            $table->tinyInteger('estatus');
            $table->decimal('precio');
            $table->unsignedBigInteger('idInventario');
            $table->foreign('idInventario')->references('idInventario')->on('inventarios');
            $table->dateTime('fechaMov');
            $table->unsignedBigInteger('idUserMov');
            $table->foreign('idUserMov')->references('idUsuario')->on('Usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
