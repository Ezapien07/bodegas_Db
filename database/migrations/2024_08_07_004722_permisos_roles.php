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
        Schema::create('permisos_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('idRol');
            $table->unsignedBigInteger('idPermiso');
            $table->dateTime('fechaMov');
            $table->foreign('idRol')->references('idRol')->on('Rol');
            $table->foreign('idPermiso')->references('idPermiso')->on('Permisos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
