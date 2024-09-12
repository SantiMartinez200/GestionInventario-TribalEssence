<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MetodoPago extends Model
{
  protected $table = 'metodo_pagos';
  protected $fillable = [
    'nombre'
  ];
    use HasFactory;
  public function venta(): HasMany
  {
    return $this->hasMany(VentaPago::class);
  }
}
