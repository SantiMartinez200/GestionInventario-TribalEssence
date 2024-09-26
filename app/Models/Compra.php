<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Compra extends Model
{
  use HasFactory;
  protected $fillable = ['usuario_id', 'caja_id', 'total'];
  public function detalleCompra(): HasOne
  {
    return $this->hasOne(CompraDetalle::class);
  }

  public function usuario(): HasMany //
  {
    return $this->hasMany(CompraDetalle::class);
  }

  public function caja(): BelongsTo
  {
    return $this->belongsTo(Caja::class);
  }
}
