<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
  protected $table = 'proveedores';
  use HasFactory;
  protected $fillable = [
    'nombre',
  ];
 
  public function compra(): HasMany
  {
    return $this->hasMany(CompraDetalle::class);
  }

  public function venta(): HasMany
  {
    return $this->hasMany(VentaDetalle::class);
  }
}
