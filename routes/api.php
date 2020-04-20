<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon; //Editor de fecha
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Calificacion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
//


//Extraer los datos de la Base de Datos para armar el DataTable
//Visualizar todo

Route::get('calificaciones', function (){
  ;
  return datatables()
    ->eloquent(Calificacion::where('estado', 0)->where('revista_calificador', $id ))
    ->addColumn('btn', 'actions')
    ->rawColumns(['btn'])
    ->toJson();
});
