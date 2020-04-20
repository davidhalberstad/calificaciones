<?php

use Illuminate\Http\Request;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reportar', 'HomeController@getReport');

Route::post('/reportar', 'HomeController@postReport');

Route::Get('productByCategory/{id}', 'CalificacionesController@byCategory');
//como pasamos la variable correspondiente al id de la categoría como parámetro en la url en la ruta lo recibimos como parámetro


Route::group(['middleware'=>'admin', 'namespace'=>'Admin'], function (){


    // Denuncias
    Route::get('/calificaciones/{id}', 'CalificacionesController@index')->name('calificaciones');
    Route::post('/calificaciones/{id}', 'CalificacionesController@store')->name('store');

    Route::get('/calificacion/{id}', 'CalificacionesController@edit')->name('edit');
    Route::post('/calificacion/{id}', 'CalificacionesController@update');
    Route::get('/editar', 'CalificacionesController@editar')->name('editar');

    Route::get('/denuncia/{id}/eliminar', 'CalificacionesController@delete')->name('delete');

    Route::get('/visualizar', 'CalificacionesController@visualizar')->name('visualizar');

    Route::get('/aprobar', 'CalificacionesController@aprobar')->name('aprobar');

    Route::get('/notificar', 'CalificacionesController@notificar')->name('notificar');
    Route::get('/notificado/{id}', 'CalificacionesController@notificado')->name('notificado');
    Route::post('/notificado/{id}', 'CalificacionesController@notificando');


    Route::get('/home', 'CalificacionesController@home')->name('home');

   //
   // Route::resource('/calificaciones', 'CalificacionesController');

//select anidado

Route::get('productByCategory/{id}', 'CalificacionesController@byCategory')->name('productByCategory');
  //como pasamos la variable correspondiente al id de la categoría como parámetro en la url en la ruta lo recibimos como parámetro

Route::get('productBySecretaria/{id}', 'CalificacionesController@bySecretaria')->name('productBySecretaria');
  //como pasamos la variable correspondiente al id de la categoría como parámetro en la url en la ruta lo recibimos como parámetro

  //PDF
  Route::get('/imprimir/{id}', 'CalificacionesController@imprimir')->name('print');

  //Vista del Reporte de Calificacion
  Route::get('/reporte_calificacion/{id}', 'CalificacionesController@reporteCalificacion')->name('reporte_calificacion');

  //Vista del Reporte de Calificacion
  Route::get('/reporte_ficha_notificacion_calificacion/{id}', 'CalificacionesController@reporteCalificacionNotificacion')->name('reporte_ficha_notificacion_calificacion');

  //Numero de Preventivo
  Route::get('/asignar_nro_preventivo/{id}', 'CalificacionesController@editNroPreventivo')->name('editNroPreventivo');
  Route::post('/asignar_nro_preventivo/{id}', 'CalificacionesController@updateNroPreventivo');

//Vista del consulta_calificador_calificado
  // Route::get('/consulta_calificador_calificado', function () {
  //       return view('admin.calificador.consulta_calificador_calificado');
  //   })->name('consulta_calificador_calificado');
//Buscador
// Route::get("home/search/9800", "CalificacionesController@search");

//Buscar calificado
  Route::get('/consulta_calificador_calificado', 'CalificacionesController@calificado')->name('consulta_calificador_calificado');

    // // Users
    // Route::get('/usuarios', 'UserController@index');
    // Route::post('/usuarios', 'UserController@store');
    //
    // Route::get('/usuario/{id}', 'UserController@edit');
    // Route::post('/usuario/{id}', 'UserController@update');
    //
    // Route::get('/usuario/{id}/eliminar', 'UserController@delete');

    // // Projects
    // Route::get('/proyectos', 'ProjectController@index');
    // Route::post('/proyectos', 'ProjectController@store');
    //
    // Route::get('/proyecto/{id}', 'ProjectController@edit');
    // Route::post('/proyecto/{id}', 'ProjectController@update');
    //
    // Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete');
    //
    // Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore');
    //
    // //Category
    // Route::post('/categorias', 'CategoryController@store');
    // Route::post('/categoria/editar', 'CategoryController@update');
    // Route::get('/categoria/{id}/eliminar', 'CategoryController@delete');
    //
    // //Level
    // Route::post('/niveles', 'LevelController@store');
    // Route::post('/nivel/editar', 'LevelController@update');
    // Route::get('/nivel/{id}/eliminar', 'LevelController@delete');
    //
    //
    // Route::get('/config', 'ConfigController@index');
});
