<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;


class Caja extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable =[
      'estado','usuario_id','monto_inicial','comentario','monto_final','fecha_apertura','ultima_modificacion','fecha_cierre'
    ];
    
  // public function cajaHaber(): HasMany
  // {
  //   return $this->hasMany(Compra::class);
  // }
  // public function cajaDebe(): HasMany
  // {
  //   return $this->hasMany(Venta::class);
  // }
  

  public function movimientos(): HasMany{
    return $this->hasMany(MovimientosCaja::class);
  }

  public function usuarioCaja(): BelongsTo{
    return $this->belongsTo(User::class);
  }

  public function toSearchableArray()
{
    return [
        'id' => $this->id, //(Podes poner la variable tipeada (int))
        'estado' => $this->estado,
        'monto_final' =>  $this->monto_final,
        'monto_inicial' =>$this->monto_inicial,
    ];
}
}
