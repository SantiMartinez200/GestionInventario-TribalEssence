<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompraDetalle extends Model
{
  use HasFactory;
  protected $fillable = ["compra_id", "producto_id", "proveedor_id", "cantidad", "precio_costo", "aroma_id", "caja_id", "marca_id","porcentaje_ganancia","precio_venta"];
  protected $table = 'compra_detalles';
  public function compra(): BelongsTo //
  {
    return $this->belongsTo(Compra::class);
  }
  public function producto(): BelongsTo //
  {
    return $this->belongsTo(Producto::class);
  }

  public function proveedor(): BelongsTo //
  {
    return $this->belongsTo(Proveedor::class);
  }

  public function aroma(): BelongsTo //
  {
    return $this->belongsTo(Aroma::class);
  }
}
