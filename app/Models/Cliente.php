<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
  use HasFactory;
  protected $fillable = [
    'dni',
    'nombre',
    'apellido',
    'telefono',
    'direccion_calle',
    'direccion_numero',
  ];
  public function venta(): HasMany
  {
    return $this->hasMany(VentaDetalle::class);
  }
}
