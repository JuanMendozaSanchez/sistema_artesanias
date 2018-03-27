<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDetalleVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->unsignedInteger('folio');
            $table->foreign('folio')->references('id')->on('venta');
            $table->unsignedInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('articulo');
            $table->string('nombre_producto');
            $table->string('cantidad');
            $table->float('precio_unitario');
            $table->string('total');
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
        Schema::dropIfExists('detalle_venta');
    }
}
