<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
  protected $table = 'traslados';

  public function calificacion()
  {
      return $this->belongsTo('App\Calificacion');
  }

}
