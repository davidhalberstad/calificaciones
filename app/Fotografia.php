<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotografia extends Model
{
  protected $table = 'fotografia';

  public function policia()
  {
      return $this->belongsTo('App\Policia');
  }

}
