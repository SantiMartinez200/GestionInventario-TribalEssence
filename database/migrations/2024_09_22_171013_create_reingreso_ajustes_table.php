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
    Schema::create('reingreso_ajustes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('compra_detalle_id');
      $table->foreignId('movimiento_caja_id');
      $table->foreignId('usuario_id');
      $table->integer('cantidad_reingreso')->nullable();
      $table->integer('cantidad_ajuste')->nullable();
      $table->enum('tipo', ['reingreso', 'ajuste']);
      $table->string('motivo')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reingreso_ajustes');
  }
};
