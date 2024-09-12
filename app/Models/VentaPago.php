<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VentaPago extends Model
{
    use HasFactory;
  public function metodo(): BelongsTo
  {
    return $this->belongsTo(MetodoPago::class);
  }
}
