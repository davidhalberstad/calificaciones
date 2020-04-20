<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->

      <title> {{ $calificaciones['revista'] }}</title>


    <style type="text/css">

    @media all {								/* Creo los saltos de paginas para poder imprimir en la siguiente pagina */
       div.saltopagina{
          display: none;
       }
    }

    @media print{
       div.saltopagina{
          display:block;
          page-break-before:always;
       }
    }
    </style>
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> -->
    <!-- GOOGLE FONT -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->

      <link rel="stylesheet" href="{!! asset('bootstrap-3.3.7/dist/css/bootstrap.min.css') !!}">

</head>
<body>
  <!-- Encabezado y Fotografia  -->
  <div class="container">
  <div class="row">
@if($fotografias != null)
        <div class="col-xs-6">
            <img alt="Fotografia" src="{{ $ruta_fotografia_sarhpolmis }}/{{ $fotografias->descripcion }}" width="200" height="166" class="img-fluid img-thumbnail" />
        </div>
@else
        <div class="col-xs-6">
            <img alt="Sin Fotografia" src="" width="200" height="166" class="img-fluid img-thumbnail" />
        </div>
@endif
      <div class="col-xs-6 text-left">
          <h3>INFORME DE CALIFICACIÓN</h3>
          <h3> PERIODO: {{ $inicio_periodo }} / {{ $fin_periodo }} </h3>
          <h1><small>Referencia # {{ $calificaciones->id }}</small></h1>
      </div>
    </div>
  </div>
  <!-- Fin Encabezado y Fotografia  -->

  <!-- Datos Partulares  -->
  <div class="container">
    <!-- <pre>Datos Particulares</pre> -->
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><strong>{{ $policias->jerarquia }} {{ $policias->apellido }}, {{ $policias->nombres }} - Legajo Nro: {{ $policias->revista }}</strong></h4>
                </div>
                <div class="panel-body">
                  <u>DNI Nro:</u> {{  $policias->nrodu  }} - <u>Edad:</u> {{ $policias->fecha_nacimiento }} -
                  <u>Destino:</u> {{ $policias->dependencia }} -
                  <u>Tarea:</u> {{ $policias->tarea }}
                  @if ($afectados == true)
                  - <em>Afectado:<u>{{ $afectados->lugar }}</u></em></br>
                  @endif
                </div>
            </div>
        </div>
      </div>
  </div>
  <!-- Fin Datos Partulares  -->

<!-- Destinos  -->
<div class="container">
  <pre>a) SERVICIOS Y DESTINOS:</pre>

  @if ($traslados->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
    <table class="table table-bordered table-striped table table-hover">
      <thead>
          <tr>
              <th>
                  <h5>#</h5>
              </th>
              <th>
                  <h5>DESTINOS</h5>
              </th>
              <th>
                  <h5>MOVIMIENTO</h5>
              </th>
              <th>
                  <h5>FECHA</h5>
              </th>
          </tr>
      </thead>
    <tbody>
      @php
        $fila = 1
      @endphp
      @foreach ($traslados as $value)
        <tr>
            <td>{{ $filas = $fila++ }}</td>
            <td>{{ $value->lugar }}</td>
            <td>{{ $value->movimiento }}</td>
            <td>{{ \Carbon\Carbon::parse($value->fecha)->format('d-m-Y') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>
<!--  Fin  -->

<!-- Parte de Enfermos  -->
<div class="container">
  <pre>b) PARTES DE ENFERMO:</pre>
  @if ($partes_enfermos->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
    <table class="table table-bordered table-striped table table-hover">
      <thead>
          <tr>
            <th>
                <h5>#</h5>
            </th>
            <th>
                <h5>F. DESDE</h5>
            </th>
            <th>
                <h5>F. HASTA</h5>
            </th>
            <th>
                <h5>DÍAS</h5>
            </th>
            <th>
                <h5>ARTÍCULO</h5>
            </th>
            <th>
                <h5>DIAGNÓSTICO</h5>
            </th>
          </tr>
      </thead>
    <tbody>
      @php
        $fila = 1
      @endphp
      @foreach ($partes_enfermos as $value)
        <tr>
            <td>{{ $filas = $fila++ }}</td>
            <td>{{ \Carbon\Carbon::parse($value->desde)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($value->hasta)->format('d-m-Y') }}</td>
            <td>{{ $value->dias }}</td>
            <td>{{ $value->articulo }}</td>
            <td>{{ $value->diagnostico }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>
<!--  Fin  -->

<!-- Licencias  -->
<div class="container">
  <pre>c) LICENCIAS - ANUAL, ESTUDIOS Y OTROS:</pre>
  @if ($licencias->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
  <table class="table table-bordered table-striped table table-hover">
    <thead>
        <tr>
            <th>
                <h5>#</h5>
            </th>
            <th>
                <h5>F. DESDE</h5>
            </th>
            <th>
                <h5>F. HASTA</h5>
            </th>
            <th>
                <h5>DÍAS</h5>
            </th>
            <th>
                <h5>ARTÍCULO</h5>
            </th>
            <th>
                <h5>DIAGNÓSTICO</h5>
            </th>
        </tr>
    </thead>
  <tbody>
      @php
        $fila = 1
      @endphp
      @foreach ($licencias as $value)
        <tr>
            <td>{{ $filas = $fila++ }}</td>
            <td>{{ \Carbon\Carbon::parse($value->desde)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($value->hasta)->format('d-m-Y') }}</td>
            <td>{{ $value->dias }}</td>
            <td>{{ $value->articulo }}</td>
            <td>{{ $value->diagnostico }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>
<!--  Fin  -->

<!-- Tiempo que no presto servicio  -->
<div class="container">
  <pre>d) TIEMPO QUE NO PRESTO SERVICIOS:</pre>
  @if ($situaciones->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
  <table class="table table-bordered table-striped table table-hover">
    <thead>
      <tr>
          <th>
              <h5>#</h5>
          </th>
          <th>
              <h5>F. DESDE</h5>
          </th>
          <th>
              <h5>F. HASTA</h5>
          </th>
          <th>
              <h5>DÍAS</h5>
          </th>
          <th>
              <h5>CAUSA</h5>
          </th>
          <th>
              <h5>TIPO</h5>
          </th>
          <th>
              <h5>DISPOSICIÓN</h5>
          </th>
      </tr>
    </thead>
  <tbody>
      @php
        $fila = 1
      @endphp
      @foreach ($situaciones as $value)
        <tr>
            <td>{{ $filas = $fila++ }}</td>
            <td>{{ \Carbon\Carbon::parse($value->desde)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($value->hasta)->format('d-m-Y') }}</td>
            <td>{{ $value->dias }}</td>
            <td>{{ $value->causa }}</td>
            <td>{{ $value->tipo }}</td>
            <td>{{ $value->disposicion }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>
<!--  Fin  -->

<!-- Embargos  -->
<div class="container">
  <pre>e) EMBARGOS REGISTRADOS DURANTE EL PERIODO:</pre>
  @if ($embargos->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
  <table class="table table-bordered table-striped table table-hover">
    <thead>
        <tr>
            <th>
                <h5>#</h5>
            </th>
            <th>
                <h5>FECHA</h5>
            </th>
            <th>
                <h5>JUZGADO</h5>
            </th>
            <th>
                <h5>ACREEDOR</h5>
            </th>
            <th>
                <h5>EXPEDIENTE</h5>
            </th>
            <th>
                <h5>SUMARIO</h5>
            </th>
            <th>
                <h5>DEPENDENCIA</h5>
            </th>
            <th>
                <h5>OFICIO</h5>
            </th>
        </tr>
    </thead>
  <tbody>
      @php
        $fila = 1
      @endphp
      @foreach ($embargos as $value)
        <tr>
            <td>{{ $filas = $fila++ }}</td>
            <td>{{ \Carbon\Carbon::parse($value->fecha)->format('d-m-Y') }}</td>
            <td>{{ $value->juzgado }}</td>
            <td>{{ $value->acreedor }}</td>
            <td>{{ $value->expediente }}</td>
            <td>{{ $value->sumario }}</td>
            <td>{{ $value->dependencia }}</td>
            <td>{{ $value->oficio }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>
<!--  Fin  -->

<!-- Sanciones  -->
<div class="container">
  <pre>f) CASTIGOS Y PENAS:</pre>
  @if ($sanciones->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
  <table class="table table-bordered table-striped table table-hover">
    <thead>
      <tr>
          <th>
              <h5>#</h5>
          </th>
          <th>
              <h5>FECHA</h5>
          </th>
          <th>
              <h5>DURACIÓN</h5>
          </th>
          <th>
              <h5>CASTIGO</h5>
          </th>
          <th>
              <h5>CAUSA</h5>
          </th>
          <th>
              <h5>ARTÍCULOS</h5>
          </th>
      </tr>
    </thead>
  <tbody>
      @php
        $fila = 1
      @endphp
      @foreach ($sanciones as $value)
        <tr>
            <td>{{ $filas = $fila++ }}</td>
            <td>{{ \Carbon\Carbon::parse($value->fecha_s)->format('d-m-Y') }}</td>
            <td>{{ $value->duracion }}</td>
            <td>{{ $value->castigo }}</td>
            <td>{{ $value->causa }}</td>
            <td>{{ $value->articulos }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
</div>
<!--  Fin  -->


<!-- Salto de linea -->
  <div class="saltopagina"></div>

<!-- Calificaciones  -->
<div class="container">
  <pre>j) CALIFICACIÓN DE LAS DISTINTAS INSTANCIAS:</pre>
  @if ($calificados->isEmpty())
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
    @php
      $fila = 1
    @endphp
    @foreach ($calificados as $calificado)
      <div class="row">
          <div class="col-xs-12">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h5>
                        <strong>
                          <p>Calificador Nro. {{ $filas = $fila++ }}:
                          {{ $calificado->jerarquia_calificador }}  {{ $calificado->nombres_calificador }}  {{ $calificado->apellido_calificador }}</p>
                        </strong>
                      </h5>
                  </div>
                  <div class="panel-body">
                    <h5><u>Tipo Calificación:</u> {{ $calificado->tipo_calificacion }} - <u>Fecha Desde:</u> {{ \Carbon\Carbon::parse($calificado->fecha_desde)->format('d-m-Y') }} - <u>Fecha Hasta:</u> {{ \Carbon\Carbon::parse($calificado->fecha_hasta)->format('d-m-Y') }}</h5></br>
                    <h5><u>CARÁCTER:</u> {{ $calificado->caracter }} - <u>MANDO:</u> {{ $calificado->mando }} - <u>ESPÍRITU POLICIAL:</u> {{ $calificado->espiritu_policial }} - <u>COMPROMISO PROFESIONAL:</u> {{ $calificado->compromiso_profesional }} - <u>ÉTICA Y CONDUCTA:</u> {{ $calificado->etica_conducta }} - <strong><u>PROMEDIO:</u></strong> {{ $calificado->promedio }} </h5></br>
                    <h5><u>JUICIO SINTÉTICO:</u> {{ $calificado->juicio_sintetico }} </h5></br>
                    <h5><u>FECHA DE APROBACION DE LA CALIFICACION:</u>
                      @if($calificado->fecha_aprobado == null)
                       Sin Aprobación por parte del Calificador
                      @else
                      {{ $calificado->fecha_aprobado }}
                      @endif
                    </h5>
                  </div>
              </div>
          </div>
      </div>
    @endforeach
  @endif
</div>
<!--  Fin  -->

<!-- Resumen de Calificaciones  -->
<div class="container">
  <pre>l) RESUMEN DE CALIFICACIONES:</pre>
  @if ($promedios_general == null)
    <div>
              Sin Registros en el Periodo Calificatorio
    </div> <br>
  @else
      <div class="row">
          <div class="col-xs-12">
              <div class="panel panel-default">
                  <div class="panel-body">
                    <h5><u>CARÁCTER:</u> {{ $promedios_caracter }} - <u>MANDO:</u> {{ $promedios_mando }} - <u>ESPÍRITU POLICIAL:</u> {{ $promedios_espiritu_policial }} - <u>COMPROMISO PROFESIONAL:</u> {{ $promedios_compromiso_profesional }} - <u>ÉTICA Y CONDUCTA:</u> {{ $promedios_etica_conducta }} - <strong><u>PROMEDIO GENERAL:</u></strong> {{ $promedios_general}} </h5></br>
                  </div>
              </div>
          </div>
      </div>
  @endif
</div>
<!--  Fin  -->




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- recarga automotica -->
<script src="http://localhost:35729/livereload.js"></script>

</body>
</html>
