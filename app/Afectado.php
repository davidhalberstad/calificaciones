<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afectado extends Model
{
  protected $table = 'afectaciones';

  public function policia()
  {
      return $this->belongsTo('App\Policia');
  }

}
