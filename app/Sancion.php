<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
  protected $table = 'sanciones';

  public function policia()
  {
      return $this->belongsTo('App\Policia');
  }

}
