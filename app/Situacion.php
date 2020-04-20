<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacion extends Model
{
  protected $table = 'situacion';

  public function policia()
  {
      return $this->belongsTo('App\Policia');
  }

}
