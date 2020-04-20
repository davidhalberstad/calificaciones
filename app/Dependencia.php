<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
      protected $table = 'dependencias';

      public function preventivo_judicial()
      {
          return $this->belongsTo('App\PreventivoJudicial');
      }

}
