<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['total', 'usuario_id', 'caja_id'];
  public function detalleVenta(): HasMany
  {
    return $this->hasMany(VentaDetalle::class);
  }
  public function usuario(): HasMany
  {
    return $this->hasMany(User::class);
  }
  public function caja(): HasMany
  {
    return $this->hasMany(Caja::class);
  }
}
