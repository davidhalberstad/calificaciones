<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon; //Editor de fecha
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Policia;
use App\Calificacion;
use App\Traslado;
use App\Fotografia;
use App\Afectado;
use App\ParteEnfermo;
use App\Situacion;
use App\Embargo;
use App\Sancion;

class JuntaController extends Controller
{

//Index
    public function index($id)
    {
      $calificador = DB::table('destinoactual')
                      ->whereRevista(auth()->user()->revista)
                      ->first();

      $calificado = DB::table('destinoactual')
                      ->whereRevista($id)
                      ->get();


      //parametros de antecedentes
      Carbon::setLocale('es');
      $ruta_fotografia_sarhpolmis = 'http://190.139.107.170:8080/legajo_virtual/'; //Ruta del servidor SARHPOLMIS donde estan las fotografias
      //Parametros del Periodo Calificatorio Anual
      $inicio_anio = date('Y', strtotime('-1 year'));
      $fin_anio =  date('Y');

      $inicio_periodo = $inicio_anio.'-08-01';
      $fin_periodo = $fin_anio.'-07-31';
      //Fin

      $calificaciones = Calificacion::where('id', $id)->first();

      $revista_calificado = $id;

      $policias = Policia::where('revista', $revista_calificado)->first();

      $fotografias = Fotografia::where('revista', $revista_calificado)
                                ->orderBy('fecha', 'desc')
                                ->first();

      $traslados = Traslado::where('revista', $revista_calificado)
                            ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                            ->get();

      $afectados = Afectado::where('revista', $revista_calificado)
                            ->whereNull('egreso')
                            ->first();

      $partes_enfermos = ParteEnfermo::where('revista', $revista_calificado)
                            ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                            ->whereNotIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                            ->orderBy('desde', 'ASC')
                            ->get();

      $partes_enfermos_razones_salud = ParteEnfermo::where('revista', $revista_calificado)
                            ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                            ->whereIn('articulo', ['*'])
                            ->orderBy('desde', 'ASC')
                            ->get();

      $licencias = ParteEnfermo::where('revista', $revista_calificado)
                            ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                            ->whereIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                            ->orderBy('desde', 'ASC')
                            ->get();

      $situaciones = Situacion::where('revista', $revista_calificado)
                                      //incio Consulta Anidada
                                      ->where(function ($query) {
                                          //Parametros del Periodo Calificatorio Anual
                                          $inicio_anio = date('Y', strtotime('-1 year'));
                                          $fin_anio =  date('Y');

                                          $inicio_periodo = $inicio_anio.'-08-01';
                                          $fin_periodo = $fin_anio.'-07-31';
                                        //Consulta Anidada
                                        $query->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                              ->orWhereNull('hasta');
                                        })//fin
                            ->orderBy('desde', 'ASC')
                            ->get();

        $embargos = Embargo::where('revista', $revista_calificado)
                              ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                              ->orderBy('fecha', 'ASC')
                              ->get();

        $sanciones = Sancion::where('revista', $revista_calificado)
                              ->whereBetween('fecha_s', [$inicio_periodo, $fin_periodo])
                              ->orderBy('fecha_s', 'ASC')
                              ->get();

        $calificados = Calificacion::where('revista', $revista_calificado)->get();

        $promedios_caracter = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('caracter');

        $promedios_mando = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('mando');

        $promedios_espiritu_policial = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('espiritu_policial');

        $promedios_compromiso_profesional = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('compromiso_profesional');

        $promedios_etica_conducta = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('etica_conducta');

        $promedios_general = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('promedio');

        $motivos_calificaciones = DB::table('ci_motivos_calificaciones')
                                ->orderBy('id_motivo_calificacion', 'asc')
                                ->get();

      return view('admin.calificador.index')->with(compact('calificador', 'calificado', 'calificaciones', 'traslados', 'fotografias', 'ruta_fotografia_sarhpolmis', 'inicio_periodo', 'fin_periodo', 'policias', 'afectados', 'partes_enfermos', 'licencias', 'situaciones', 'embargos', 'sanciones', 'calificados', 'promedios_caracter', 'promedios_mando', 'promedios_espiritu_policial', 'promedios_compromiso_profesional', 'promedios_etica_conducta', 'promedios_general', 'partes_enfermos_razones_salud', 'motivos_calificaciones'));
    }

    public function store(Request $request)
    {
      $calificacion = new Calificacion();

      //Control de parametros
      $revista = $request->input('revista');
      $revista_calificador = $request->input('revista_calificador');
      if($revista_calificador == $revista){
          return back()->with('error', 'Error: No se puede calificar a uno mismo. Corrija e Intente nuevamente. Gracias!!!');
      }else{

      // Carga
      $calificacion->revista = $request->input('revista');
      $calificacion->jerarquia = $request->input('jerarquia');
      $calificacion->nombres = $request->input('nombres');
      $calificacion->apellido = $request->input('apellido');
      $calificacion->dependencia_calificado = $request->input('dependencia_calificado');

      $calificacion->caracter = $request->input('caracter');
      $calificacion->mando = $request->input('mando');
      $calificacion->espiritu_policial = $request->input('espiritu_policial');
      $calificacion->compromiso_profesional = $request->input('compromiso_profesional');
      $calificacion->etica_conducta = $request->input('etica_conducta');

      $calificacion->promedio = ($request->input('caracter')+$request->input('mando')+$request->input('espiritu_policial')+$request->input('compromiso_profesional')+$request->input('etica_conducta'))/5;

      $calificacion->juicio_sintetico = $request->input('juicio_sintetico');
      $calificacion->fecha_calificacion = $request->input('fecha_calificacion');
      $calificacion->periodo = $request->input('periodo');
      $calificacion->revista_calificador = $request->input('revista_calificador');
      $calificacion->jerarquia_calificador = $request->input('jerarquia_calificador');
      $calificacion->nombres_calificador = $request->input('nombres_calificador');
      $calificacion->apellido_calificador = $request->input('apellido_calificador');
      $calificacion->dependencia = $request->input('dependencia');
      $calificacion->tipo_calificacion = $request->input('tipo_calificacion');
      $calificacion->fecha_desde = $request->input('fecha_desde');
      $calificacion->fecha_hasta = $request->input('fecha_hasta');
      $calificacion->tipo_calificador = $request->input('tipo_calificador');

// parametros de las fechas del periodo de calificacion
      $inicio_anio = date('Y', strtotime('-1 year'));
      $fin_anio =  date('Y');
      $inicio_periodo = $inicio_anio.'-08-01';
      $fin_periodo = $fin_anio.'-07-31';

      $calificacion->inicio_periodo = $inicio_periodo;
      $calificacion->fin_periodo = $fin_periodo;

      $calificacion->usuario = $request->input('usuario');
      $calificacion->fecha_carga = $request->input('fecha_carga');
      $calificacion->estado = $request->input('estado');
      $calificacion->fecha_estado = $request->input('fecha_estado');
      $calificacion->aprobado = $request->input('aprobado');
      $calificacion->fecha_aprobado = $request->input('fecha_aprobado');
      $calificacion->notificado = $request->input('notificado');
      $calificacion->fecha_notificado_sistema = $request->input('fecha_notificado_sistema');
      $calificacion->fecha_notificacion = $request->input('fecha_notificacion');
      $calificacion->hora_notificacion = $request->input('hora_notificacion');

      $calificacion->fecha_calificacion = date("Y-m-d H:i:s");
      $calificacion->usuario = auth()->user()->revista;

      $estado = $request->input('estado');
      if($estado == 0 ){
        $calificacion->estado = 0;
        $calificacion->aprobado = 0;
        $calificacion->notificado = 0;
      }else{
        $calificacion->estado = 0;
        $calificacion->aprobado = 1;
        $calificacion->fecha_aprobado = date("Y-m-d H:i:s");
        $calificacion->notificado = 0;
      }


      $calificacion->save();

      return back()->with('notification', 'Guardado Exitosamente!!!');
      }
}
//Edit
    public function edit($id)
    {

        $calificado = DB::table('calificaciones_informes')
                        ->whereId($id)
                        ->first();


        return view('admin.calificador.edit')->with(compact('calificado'));
    }


//Update
    public function update($id, Request $request)
    {

      $calificacion = new Calificacion();
      $calificacion = Calificacion::find($id);

      // Carga
      $calificacion->revista  = $request->input('revista');
      $calificacion->jerarquia = $request->input('jerarquia');
      $calificacion->nombres = $request->input('nombres');
      $calificacion->apellido = $request->input('apellido');
      $calificacion->dependencia_calificado = $request->input('dependencia_calificado');

      $calificacion->caracter = $request->input('caracter');
      $calificacion->mando = $request->input('mando');
      $calificacion->espiritu_policial = $request->input('espiritu_policial');
      $calificacion->compromiso_profesional = $request->input('compromiso_profesional');
      $calificacion->etica_conducta = $request->input('etica_conducta');

      $calificacion->promedio = ($request->input('caracter')+$request->input('mando')+$request->input('espiritu_policial')+$request->input('compromiso_profesional')+$request->input('etica_conducta'))/5;

      $calificacion->juicio_sintetico = $request->input('juicio_sintetico');
      $calificacion->fecha_calificacion = $request->input('fecha_calificacion');
      $calificacion->periodo = $request->input('periodo');
      $calificacion->revista_calificador = $request->input('revista_calificador');
      $calificacion->jerarquia_calificador = $request->input('jerarquia_calificador');
      $calificacion->nombres_calificador = $request->input('nombres_calificador');
      $calificacion->apellido_calificador = $request->input('apellido_calificador');
      $calificacion->dependencia = $request->input('dependencia');
      $calificacion->tipo_calificacion = $request->input('tipo_calificacion');
      $calificacion->fecha_desde = $request->input('fecha_desde');
      $calificacion->fecha_hasta = $request->input('fecha_hasta');
      $calificacion->tipo_calificador = $request->input('tipo_calificador');

// parametros de las fechas del periodo de calificacion
      $inicio_anio = date('Y', strtotime('-1 year'));
      $fin_anio =  date('Y');
      $inicio_periodo = $inicio_anio.'-08-01';
      $fin_periodo = $fin_anio.'-07-31';

      $calificacion->inicio_periodo = $inicio_periodo;
      $calificacion->fin_periodo = $fin_periodo;

      $calificacion->usuario = $request->input('usuario');
      $calificacion->fecha_carga = $request->input('fecha_carga');
      $calificacion->estado = $request->input('estado');
      $calificacion->fecha_estado = $request->input('fecha_estado');
      $calificacion->aprobado = $request->input('aprobado');
      $calificacion->fecha_aprobado = $request->input('fecha_aprobado');
      $calificacion->notificado = $request->input('notificado');
      $calificacion->fecha_notificado_sistema = $request->input('fecha_notificado_sistema');
      $calificacion->fecha_notificacion = $request->input('fecha_notificacion');
      $calificacion->hora_notificacion = $request->input('hora_notificacion');

      $calificacion->fecha_calificacion = date("Y-m-d H:i:s");
      $calificacion->usuario = auth()->user()->revista;

      $estado = $request->input('estado');
      if($estado == 0 ){
        $calificacion->estado = 0;
        $calificacion->aprobado = 0;
        $calificacion->notificado = 0;
      }else{
        $calificacion->estado = 0;
        $calificacion->aprobado = 1;
        $calificacion->fecha_aprobado = date("Y-m-d H:i:s");
        $calificacion->notificado = 0;
      }


      $calificacion->save();

      return back()->with('notification', 'Modificado Exitosamente!!!');
    }

//Delete
    public function delete($id)
    {
        $denuncia = Denuncias::find($id);
        $denuncia->delete();

        return back()->with('notification', 'Eliminado Exitosamente!!!');
    }

//pdf
    public function imprimir($id)
    {
      Carbon::setLocale('es');
      $ruta_fotografia_sarhpolmis = 'http://190.139.107.170:8080/legajo_virtual/'; //Ruta del servidor SARHPOLMIS donde estan las fotografias
      //Parametros del Periodo Calificatorio Anual
      $inicio_anio = date('Y', strtotime('-1 year'));
      $fin_anio =  date('Y');

      $inicio_periodo = $inicio_anio.'-08-01';
      $fin_periodo = $fin_anio.'-07-31';
      //Fin

      $calificaciones = Calificacion::where('id', $id)->first();

      $revista_calificado = $calificaciones['revista'];

      $policias = Policia::where('revista', $revista_calificado)->first();

      $fotografias = Fotografia::where('revista', $revista_calificado)
                                ->orderBy('fecha', 'desc')
                                ->first();

      $traslados = Traslado::where('revista', $revista_calificado)
                            ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                            ->get();

      $afectados = Afectado::where('revista', $revista_calificado)
                            ->whereNull('egreso')
                            ->first();

      $partes_enfermos = ParteEnfermo::where('revista', $revista_calificado)
                            ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                            ->whereNotIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                            ->orderBy('desde', 'ASC')
                            ->get();

      $licencias = ParteEnfermo::where('revista', $revista_calificado)
                            ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                            ->whereIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                            ->orderBy('desde', 'ASC')
                            ->get();

      $situaciones = Situacion::where('revista', $revista_calificado)
                                      //incio Consulta Anidada
                                      ->where(function ($query) {
                                          //Parametros del Periodo Calificatorio Anual
                                          $inicio_anio = date('Y', strtotime('-1 year'));
                                          $fin_anio =  date('Y');

                                          $inicio_periodo = $inicio_anio.'-08-01';
                                          $fin_periodo = $fin_anio.'-07-31';
                                        //Consulta Anidada
                                        $query->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                              ->orWhereNull('hasta');
                                        })//fin
                            ->orderBy('desde', 'ASC')
                            ->get();

        $embargos = Embargo::where('revista', $revista_calificado)
                              ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                              ->orderBy('fecha', 'ASC')
                              ->get();

        $sanciones = Sancion::where('revista', $revista_calificado)
                              ->whereBetween('fecha_s', [$inicio_periodo, $fin_periodo])
                              ->orderBy('fecha_s', 'ASC')
                              ->get();

        $calificados = Calificacion::where('revista', $revista_calificado)->get();

        $promedios_caracter = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('caracter');

        $promedios_mando = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('mando');

        $promedios_espiritu_policial = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('espiritu_policial');

        $promedios_compromiso_profesional = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('compromiso_profesional');

        $promedios_etica_conducta = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('etica_conducta');

        $promedios_general = DB::table('calificaciones_informes')
                                ->where('revista', $revista_calificado)
                                ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                ->avg('promedio');

      Carbon::setLocale('es');


      $pdf = \PDF::loadView('admin.calificador.reporte_calificacion', compact('calificaciones', 'traslados', 'fotografias', 'ruta_fotografia_sarhpolmis', 'inicio_periodo', 'fin_periodo', 'policias', 'afectados', 'partes_enfermos', 'licencias', 'situaciones', 'embargos', 'sanciones', 'calificados', 'promedios_caracter', 'promedios_mando', 'promedios_espiritu_policial', 'promedios_compromiso_profesional', 'promedios_etica_conducta', 'promedios_general'));
      return $pdf->stream('calificacion.pdf');
    }

    //Reporte
        public function reporteCalificacion($id)
        {
          Carbon::setLocale('es');
          $ruta_fotografia_sarhpolmis = 'http://190.139.107.170:8080/legajo_virtual/'; //Ruta del servidor SARHPOLMIS donde estan las fotografias
          //Parametros del Periodo Calificatorio Anual
          $inicio_anio = date('Y', strtotime('-1 year'));
          $fin_anio =  date('Y');

          $inicio_periodo = $inicio_anio.'-08-01';
          $fin_periodo = $fin_anio.'-07-31';
          //Fin

          $calificaciones = Calificacion::where('id', $id)->first();

          $revista_calificado = $calificaciones['revista'];

          $policias = Policia::where('revista', $revista_calificado)->first();

          $fotografias = Fotografia::where('revista', $revista_calificado)
                                    ->orderBy('fecha', 'desc')
                                    ->first();

          $traslados = Traslado::where('revista', $revista_calificado)
                                ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                                ->get();

          $afectados = Afectado::where('revista', $revista_calificado)
                                ->whereNull('egreso')
                                ->first();

          $partes_enfermos = ParteEnfermo::where('revista', $revista_calificado)
                                ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                ->whereNotIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                                ->orderBy('desde', 'ASC')
                                ->get();

          $licencias = ParteEnfermo::where('revista', $revista_calificado)
                                ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                ->whereIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                                ->orderBy('desde', 'ASC')
                                ->get();

          $situaciones = Situacion::where('revista', $revista_calificado)
                                          //incio Consulta Anidada
                                          ->where(function ($query) {
                                              //Parametros del Periodo Calificatorio Anual
                                              $inicio_anio = date('Y', strtotime('-1 year'));
                                              $fin_anio =  date('Y');

                                              $inicio_periodo = $inicio_anio.'-08-01';
                                              $fin_periodo = $fin_anio.'-07-31';
                                            //Consulta Anidada
                                            $query->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                                  ->orWhereNull('hasta');
                                            })//fin
                                ->orderBy('desde', 'ASC')
                                ->get();

            $embargos = Embargo::where('revista', $revista_calificado)
                                  ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                                  ->orderBy('fecha', 'ASC')
                                  ->get();

            $sanciones = Sancion::where('revista', $revista_calificado)
                                  ->whereBetween('fecha_s', [$inicio_periodo, $fin_periodo])
                                  ->orderBy('fecha_s', 'ASC')
                                  ->get();

            $calificados = Calificacion::where('revista', $revista_calificado)->get();

            $promedios_caracter = DB::table('calificaciones_informes')
                                    ->where('revista', $revista_calificado)
                                    ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                    ->avg('caracter');

            $promedios_mando = DB::table('calificaciones_informes')
                                    ->where('revista', $revista_calificado)
                                    ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                    ->avg('mando');

            $promedios_espiritu_policial = DB::table('calificaciones_informes')
                                    ->where('revista', $revista_calificado)
                                    ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                    ->avg('espiritu_policial');

            $promedios_compromiso_profesional = DB::table('calificaciones_informes')
                                    ->where('revista', $revista_calificado)
                                    ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                    ->avg('compromiso_profesional');

            $promedios_etica_conducta = DB::table('calificaciones_informes')
                                    ->where('revista', $revista_calificado)
                                    ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                    ->avg('etica_conducta');

            $promedios_general = DB::table('calificaciones_informes')
                                    ->where('revista', $revista_calificado)
                                    ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                    ->avg('promedio');

          Carbon::setLocale('es');

          return view('admin.calificador.reporte_calificacion')->with(compact('calificaciones', 'traslados', 'fotografias', 'ruta_fotografia_sarhpolmis', 'inicio_periodo', 'fin_periodo', 'policias', 'afectados', 'partes_enfermos', 'licencias', 'situaciones', 'embargos', 'sanciones', 'calificados', 'promedios_caracter', 'promedios_mando', 'promedios_espiritu_policial', 'promedios_compromiso_profesional', 'promedios_etica_conducta', 'promedios_general'));
        }

        //Reporte
            public function reporteCalificacionNotificacion($id)
            {
              Carbon::setLocale('es');
              $ruta_fotografia_sarhpolmis = 'http://190.139.107.170:8080/legajo_virtual/'; //Ruta del servidor SARHPOLMIS donde estan las fotografias
              //Parametros del Periodo Calificatorio Anual
              $inicio_anio = date('Y', strtotime('-1 year'));
              $fin_anio =  date('Y');

              $inicio_periodo = $inicio_anio.'-08-01';
              $fin_periodo = $fin_anio.'-07-31';
              //Fin

              $calificaciones = Calificacion::where('id', $id)->first();

              $revista_calificado = $calificaciones['revista'];

              $policias = Policia::where('revista', $revista_calificado)->first();

              $fotografias = Fotografia::where('revista', $revista_calificado)
                                        ->orderBy('fecha', 'desc')
                                        ->first();

              $traslados = Traslado::where('revista', $revista_calificado)
                                    ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                                    ->get();

              $afectados = Afectado::where('revista', $revista_calificado)
                                    ->whereNull('egreso')
                                    ->first();

              $partes_enfermos = ParteEnfermo::where('revista', $revista_calificado)
                                    ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                    ->whereNotIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                                    ->orderBy('desde', 'ASC')
                                    ->get();

              $licencias = ParteEnfermo::where('revista', $revista_calificado)
                                    ->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                    ->whereIn('articulo', ['Licencia Anual Reglamentaria', 'Franco Compensatorio', 'Licencia Extraordinaria'])
                                    ->orderBy('desde', 'ASC')
                                    ->get();

              $situaciones = Situacion::where('revista', $revista_calificado)
                                              //incio Consulta Anidada
                                              ->where(function ($query) {
                                                  //Parametros del Periodo Calificatorio Anual
                                                  $inicio_anio = date('Y', strtotime('-1 year'));
                                                  $fin_anio =  date('Y');

                                                  $inicio_periodo = $inicio_anio.'-08-01';
                                                  $fin_periodo = $fin_anio.'-07-31';
                                                //Consulta Anidada
                                                $query->whereBetween('desde', [$inicio_periodo, $fin_periodo])
                                                      ->orWhereNull('hasta');
                                                })//fin
                                    ->orderBy('desde', 'ASC')
                                    ->get();

                $embargos = Embargo::where('revista', $revista_calificado)
                                      ->whereBetween('fecha', [$inicio_periodo, $fin_periodo])
                                      ->orderBy('fecha', 'ASC')
                                      ->get();

                $sanciones = Sancion::where('revista', $revista_calificado)
                                      ->whereBetween('fecha_s', [$inicio_periodo, $fin_periodo])
                                      ->orderBy('fecha_s', 'ASC')
                                      ->get();

                $calificados = Calificacion::where('id', $id)->get();

                $promedios_caracter = DB::table('calificaciones_informes')
                                        ->where('revista', $revista_calificado)
                                        ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                        ->avg('caracter');

                $promedios_mando = DB::table('calificaciones_informes')
                                        ->where('revista', $revista_calificado)
                                        ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                        ->avg('mando');

                $promedios_espiritu_policial = DB::table('calificaciones_informes')
                                        ->where('revista', $revista_calificado)
                                        ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                        ->avg('espiritu_policial');

                $promedios_compromiso_profesional = DB::table('calificaciones_informes')
                                        ->where('revista', $revista_calificado)
                                        ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                        ->avg('compromiso_profesional');

                $promedios_etica_conducta = DB::table('calificaciones_informes')
                                        ->where('revista', $revista_calificado)
                                        ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                        ->avg('etica_conducta');

                $promedios_general = DB::table('calificaciones_informes')
                                        ->where('revista', $revista_calificado)
                                        ->whereBetween('inicio_periodo', [$inicio_periodo, $fin_periodo])
                                        ->avg('promedio');

              Carbon::setLocale('es');

              return view('admin.calificador.reporte_ficha_notificacion_calificacion')->with(compact('calificaciones', 'traslados', 'fotografias', 'ruta_fotografia_sarhpolmis', 'inicio_periodo', 'fin_periodo', 'policias', 'afectados', 'partes_enfermos', 'licencias', 'situaciones', 'embargos', 'sanciones', 'calificados', 'promedios_caracter', 'promedios_mando', 'promedios_espiritu_policial', 'promedios_compromiso_profesional', 'promedios_etica_conducta', 'promedios_general'));
            }

    //Visualizar
        public function visualizar()
        {

          $calificaciones_realizadas = Calificacion::where('estado', 0)
                            ->where('revista_calificador', auth()->user()->revista)
                            ->get();
           return view('admin.junta.visualizar')->with(compact('calificaciones_realizadas'));
        }

    //Editar
        public function editar()
        {

          $calificaciones_realizadas = Calificacion::where('aprobado', 0)
                            ->where('revista_calificador', auth()->user()->revista)
                            ->get();
           return view('admin.calificador.editar')->with(compact('calificaciones_realizadas'));
        }

    //Aprobar
        public function aprobar()
        {

          $calificaciones_realizadas = Calificacion::where('aprobado', 0)
                            ->get();
           return view('admin.junta.aprobar')->with(compact('calificaciones_realizadas'));
        }

    //Notificar
        public function notificar()
        {

          $calificaciones_realizadas = Calificacion::where('notificado', 0)
                            ->get();
           return view('admin.junta.notificar')->with(compact('calificaciones_realizadas'));
        }

    //Notificado
        public function notificado($id)
        {

          $calificado = Calificacion::whereId($id)->firstOrFail();
           return view('admin.calificador.notificado')->with(compact('calificado'));
        }

    //HOME
        public function panelControlJunta()
        {

          $calificaciones_realizadas = DB::table('calificaciones_informes')
                                          ->whereEstado(0)
                                          ->count();

          $calificaciones_sin_aprobar = DB::table('calificaciones_informes')
                                          ->whereAprobado(0)
                                          ->count();

          $calificaciones_sin_notificar = DB::table('calificaciones_informes')
                                            ->whereNotificado(0)
                                            ->count();

           return view('admin.junta.panelControlJunta')->with(compact('calificaciones_realizadas', 'calificaciones_sin_aprobar', 'calificaciones_sin_notificar' ));
        }


        //Edit Nro Preventivo
            public function editNroPreventivo($id)
            {
                $denuncia = Denuncias::findOrFail($id);
                $dependencia = Dependencia::orderBy('dependencia', 'ASC')->get();

                return view('admin.denuncias.asignar_nro_preventivo')->with(compact('denuncia', 'dependencia'));
            }

        //Update Nro Preventivo
            public function updateNroPreventivo($id, Request $request)
            {
                  // Asignacion de Nro de Preventivo
                $preventivo_judicial = new PreventivoJudicial();

                $preventivo_judicial->nro_preventivo = $request->input('nro_preventivo');
                $preventivo_judicial->anio_preventivo = $request->input('anio_preventivo');
                $preventivo_judicial->dependencia = $request->input('dependencia');
                $preventivo_judicial->estado = 2;

                $preventivo_judicial->save();

                return back()->with('notification', 'Modificado Exitosamente!!!');
            }


//Calificado
    public function calificado()
    {
      $destino_calificador = Policia::where('revista', auth()->user()->revista)->first();

      $policias = DB::table('destinoactual')
                              ->where('dependencia', $destino_calificador->dependencia)
                              ->get();

       return view('admin.calificador.consulta_calificador_calificado')->with(compact('policias'));
    }

    //Update
        public function notificando($id, Request $request)
        {

          $calificacion = new Calificacion();
          $calificacion = Calificacion::find($id);

          // Carga
          $calificacion->fecha_calificacion = date("Y-m-d H:i:s");
          $calificacion->usuario = auth()->user()->revista;
          $calificacion->fecha_notificacion = $request->input('fecha_notificacion');
          $calificacion->fecha_notificado_sistema = date("Y-m-d H:i:s");

          $calificacion->notificado = 1;

          $calificacion->save();

          return back()->with('notification', 'Notificado Exitosamente!!!');
        }

}
