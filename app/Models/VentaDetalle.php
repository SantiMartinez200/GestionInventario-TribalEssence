<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VentaDetalle extends Model
{
  protected $table = "venta_detalles";
  protected $fillable = ['compra_detalle_id','venta_id', 'marca_id', 'producto_id', 'proveedor_id', 'aroma_id', 'cantidad', 'precio_venta'];
  use HasFactory;
  public function venta(): BelongsTo //
  {
    return $this->belongsTo(Venta::class);
  }

  public function caja(): BelongsTo
  {
    return $this->belongsTo(Caja::class);
  }

  public function cliente(): BelongsTo //
  {
    return $this->belongsTo(Cliente::class);
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

  public function compraDetalle(): BelongsTo //
  {
    return $this->BelongsTo(compraDetalle::class);
  }


}
