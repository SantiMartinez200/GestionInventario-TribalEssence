<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReingresoAjuste extends Model
{
    use HasFactory;
  protected $fillable = ['compra_detalle_id', 'movimiento_caja_id', 'usuario_id', 'cantidad_reingreso', 'cantidad_ajuste', 'tipo', 'motivo'];


  public function detalle(): BelongsTo{
    return $this->belongsTo(CompraDetalle::class);
  }
}
