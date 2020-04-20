<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embargo extends Model
{
  protected $table = 'embargos';

  public function policia()
  {
      return $this->belongsTo('App\Policia');
  }

}
