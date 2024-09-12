<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientosCaja extends Model
{
    use HasFactory;
  protected $table = "movimientos_caja";
  protected $fillable = ['caja_id','tipo_movimiento','monto','descripcion'];

  public function caja(): BelongsTo{
    return $this->belongsTo(Caja::class);
  }
}
