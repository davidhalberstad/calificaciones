<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParteEnfermo extends Model
{
  protected $table = 'medic_certificado';

  public function calificacion()
  {
      return $this->belongsTo('App\Calificacion');
  }

}
