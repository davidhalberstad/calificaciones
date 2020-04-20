<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
  protected $table = 'calificaciones_informes';

  public function traslado()
  {
      return $this->hasMany('App\Traslado');
  }

}
