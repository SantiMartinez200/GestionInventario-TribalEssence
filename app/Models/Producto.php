<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
  protected $fillable = [
    'nombre',
    'precio_costo',
    'codigo',
    'descripcion'
  ];

  use HasFactory;
  public function compra(): HasMany
  {
    return $this->hasMany(CompraDetalle::class);
  }
  public function venta(): HasMany
  {
    return $this->hasMany(VentaDetalle::class);
  }
}
