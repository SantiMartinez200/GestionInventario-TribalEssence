<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('movimientos_caja', function (Blueprint $table) {
      $table->id();
      $table->integer('caja_id');
      $table->enum('tipo_movimiento',['Entrada','Salida']);
      $table->double('monto');
      $table->string('descripcion');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('movimientos_caja');
  }
};
