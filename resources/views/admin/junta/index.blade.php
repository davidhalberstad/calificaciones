@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Alta Calificaciones</div>

    <div class="panel-body">
            @if(session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
      </div>

        <div class="panel-body">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
      </div>

@php
$ayuda_caracter = "I) CARÁCTER:
  INFLUYE LOS CASTIGOS - CONDICIONES FISICAS - SITUACION ECONOMICA
  100 PUNTOS:: Personalidad descollante, ejemplo por su responsabilidad destacándose sobre el resto.
  90 a 99 PUNTOS:: Personalidad notable, profundo sentido de la responsabilidad.
  80 a 89 PUNTOS:: Personalidad muy desarrollada, se releva como responsable.
  60 a 79 PUNTOS:: Personalidad desarrollada.
  40 a 59 PUNTOS:: Carece de personalidad obrando con limitaciones en ciertos casos.
  00 a 39 PUNTOS:: No tiene las cualidades que correspondan a su grado y condiciones.
  ";

  $ayuda_mando = "II) MANDO:
  INFLUYE LOS CASTIGOS - CONDICIONES FISICAS - INSPECCIONES
  100 PUNTOS:   Despierta entusiasmo e inspira confianza en grado apreciable  en  el  personal  que  le esta subordinado,
  obrando con ejemplo y logrando convicción. Posee ascendiente y valora exactamente a los mismos.
  90 a 99 PUNTOS: Hace cumplir las ordenes y disposiciones inspirando confianza y atrayendo a sus subordinados, sin recurrir a métodos correctivos. Valor bien a los mismos.
  80 a 89 PUNTOS: Sabe mandar en grado conveniente y se hace obedecer sin provocar resentimiento.
  60 a 79 PUNTOS: Manda sin atraerse la consideración y confianza de sus subordinados. No valora adecuadamente a los mismos.
  40 a 59 PUNTOS: No inspira confianza ni respeto a sus subordinados. Crea resentimiento en la forma arbitraria en que da las órdenes. No sabe  valorar a sus subordinados.
  0 a 39 PUNTOS: Inepto para el ejercicio del mando y/o funciones. No inspira confianza en absoluto.
  ";

  $ayuda_espiritu_policial = "III) ESPÍRITU POLICIAL:
  INFLUYE LOS CASTIGOS - CONDICIONES FISICAS
  100 PUNTOS:  Se destaca nítidamente por su espíritu de sacrificio y cumplimiento del deber
  90 a 99 PUNTOS: Gran entusiasmo y dedicación al cumplimiento de las  funciones.
  80 a 89 PUNTOS: Cumple sus obligaciones en forma muy satisfactoria.
  60 a 79 PUNTOS: Satisface en el desempeño de sus funciones.
  40 a 59 PUNTOS: Realiza nada más que lo indispensable sin esmerarse en mejorar su situación.
  0 a 39 PUNTOS: No satisface en el cumplimiento de sus obligaciones.
  ";

  $ayuda_compromiso_profesional = "IV) COMPROMISO PROFESIONAL:
  INFLUYE LOS RESULTADOS DE CARGOS Y PRUEBAS - INSPECCIONES
  100 PUNTOS: Excepcionalmente capacitado para el ejercicio de sus funciones. Sobresaliente aptitudes para ejercer cualquier tipo de tareas.
  90 a 99 PUNTOS: Amplios conocimientos generales y profesionales. Revela preocupación para acrecentar los mismos.
  80 a 89 PUNTOS: Competente en el ejercicio de su profesión. Prestigiado entre sus iguales.
  60 a 79 PUNTOS: Se desenvuelve satisfactoriamente en sus funciones específicas.
  40 a 59 PUNTOS:  Medianamente capacitado para el desempeño de sus funciones, no demuestra afán de superación.
  0 a 30 PUNTOS: Incompetente y carente de capacidad para el desenvolvimiento de sus funciones.
  ";

  $ayuda_etica_conducta = "V) ETICA Y CONDUCTA:
    INFLUYE LOS CASTIGOS - SITUACION ECONOMICA
  100 PUNTOS: Conducta moral, pública y privada insuperable, se destaca en todos sus aspectos. Muy respetuoso, correcto y leal, goza de gran prestigio, jamás a sido observado ni sancionado.
  90 a 99 PUNTOS: Buena conducta moral, pública y privada, respetuoso correcto y leal.
  80 a 89 PUNTOS: Buen comportamiento, a sido observado y sancionado en muy pocas oportunidades y por faltas de poca trascendencia.
  60 a 79 PUNTOS: Su conducta moral es buena, tiene concepto claro de la camaradería  y la lealtad: a sido sancionado pocas veces.
  40 a 59 PUNTOS: Su conducta es regular, sus conductas y hábitos sin llegar a extremos ofrecen motivos de críticas. Ha sido sancionado en reiteradas oportunidades.
  0 a 39 PUNTOS: Tiene mala conducta: sus conductas y hábitos significan un desprestigio para la Institución. Debe ser separado de la misma.
  ";

  $ayuda_juicio_sintetico = "Valoración resumida para justificar la calificación impuesta.";

  $ayuda_aprobacion_calificacion = "Al guardar la Calificación Seleccionando: CALIFICACION APROBADA, significa que el Calificador guarda la calificación y no la va a poder modificar nuevamente, se entiende que es como la elevación de la calificación para ser notificado al Calificado. En caso contrario si se guarda la calificación sin APROBARLA, el calificador si podrá más adelante realizar modificaciones en la misma, pero recién cuando la Apruebe se va a poder Notificar al Personal Calificado.";
@endphp

    <div class="card-body">
        <form action="" method="POST" oninput='resultado.value=(parseInt(caracter.value) + parseInt(mando.value) + parseInt(espiritu_policial.value) + parseInt(compromiso_profesional.value) + parseInt(etica_conducta.value))/5' >
            {{ csrf_field() }}

<!-- Comienza el formulario de Denuncia Corta Online -->
<div class="row">
      <div class="table-responsive" class="container">
        <h3>Datos del Calificado</h3>
        <table id="example" class="table table-bordered table-striped table-hover" >
            <thead>
                <tr>
                    <th width="10%">Revista</th>
                    <th width="15%">Jerarquia</th>
                    <th width="20%">Apellido</th>
                    <th width="20%">Nombres</th>
                    <th width="25%">Dependencia</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($calificado as $value)
                <tr>
                  <td>{{ $value->revista }}</td>
                  <td>{{ $value->jerarquia }}</td>
                  <td>{{ $value->apellido }}</td>
                  <td>{{ $value->nombres }}</td>
                  <td>{{ $value->dependencia }}</td>
<input id="revista" name="revista" type="hidden" value="{{ $value->revista }}">
<input id="jerarquia" name="jerarquia" type="hidden" value="{{ $value->jerarquia }}">
<input id="apellido" name="apellido" type="hidden" value="{{ $value->apellido }}">
<input id="nombres" name="nombres" type="hidden" value="{{ $value->nombres }}">
<input id="dependencia_calificado" name="dependencia_calificado" type="hidden" value="{{ $value->dependencia }}">
                </tr>
              @endforeach
            </tbody>

        </table>
      </div>
</div>

<!-- resumen de antecedentes -->
<!-- Periodo calificatorio -->
<hr> </hr>
<div class="form-group">
    <h3>*Resumen de Antecedentes en el Periodo Calificatorio* </h3>
</div>
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
            <td>{{ $value->hasta }}</td>
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
            <td>@if($value->desde) {{ \Carbon\Carbon::parse($value->desde)->format('d-m-Y') }} @endif</td>
            <td>@if($value->hasta) {{ \Carbon\Carbon::parse($value->hasta)->format('d-m-Y') }} @endif</td>
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

<!-- fin resumen antecedentes -->

<!-- datos del calificador -->
<input id="revista_calificador" name="revista_calificador" type="hidden" value="{{ $calificador->revista }}">
<input id="jerarquia_calificador" name="jerarquia_calificador" type="hidden" value="{{ $calificador->jerarquia }}">
<input id="apellido_calificador" name="apellido_calificador" type="hidden" value="{{ $calificador->apellido }}">
<input id="nombres_calificador" name="nombres_calificador" type="hidden" value="{{ $calificador->nombres }}">
<input id="dependencia" name="dependencia" type="hidden" value="{{ $calificador->dependencia }}">


              <!-- Periodo calificatorio -->
              <hr> </hr>
              <div class="form-group">
                  <h3>*Periodo Calificatorio* </h3>
              </div>


              <div class="form-group">
                  <label for="tipo_calificacion">Motivo de la Calificación </label>
                  <select name="tipo_calificacion" id="tipo_calificacion" class="form-control" required>
                      <option selected value="">Seleccionar</option>
                      @foreach( $motivos_calificaciones as $item )
                      <option value="{{ $item->motivo_calificacion }}">{{ $item->motivo_calificacion }}</option>
                      @endforeach
                  </select>
              </div>

              <!-- <div class="form-group">
                <label for="tipo_calificacion">Instancia de Calificación  </label>
                    <input type="text" name="tipo_calificacion" class="form-control" value="{{ old('tipo_calificacion') }}" required>
              </div> -->

            <div class="row">
              <div class="form-group" >
                <div class="col-md-12">
                <label for="fecha_desde">Fecha Desde  </label>
                    <input id="fecha_desde" type="date" name="fecha_desde" class="form-control" value="{{ old('fecha_desde') }}" required>
                </div>
              </div>

              <div class="form-group" >
                <div class="col-md-12">
                <label for="fecha_hasta">Fecha Hasta  </label>
                    <input id="fecha_hasta" type="date" name="fecha_hasta" class="form-control" value="{{ old('fecha_hasta') }}"required>
                </div>
              </div>
            </div>

              <div class="form-group">
                <label for="fecha_hasta">Cantidad de Días de calificación: <span id="dias"</span> </label>
              </div>


              <!-- Calificacion  -->
              <hr> </hr>
              <div class="form-group">
                  <h3>*Calificación* </h3>
              </div>
              @php
                if ($sanciones->isEmpty()){
                  $max = 100;
                }else{
                  $max = 99;
                }

                if ($partes_enfermos_razones_salud->isEmpty()){
                  $max = 100;
                }else{
                  $max = 99;
                }
              @endphp


              <div class="panel-body">
                      @if (!$sanciones->isEmpty())
                        <div class="alert alert-warning">
                            IMPORTANTE: El calificado posee sanciones disciplinarias dentro del periodo calificatorio, por tal motivo no puede califcársele 100 puntos en los guarismos de: CARACTER, MANDO, ESPIRITU POLICIAL Y ETICA Y CONDUCTA.
                        </div>
                      @endif

                      @if (!$partes_enfermos_razones_salud->isEmpty())
                        <div class="alert alert-warning">
                            IMPORTANTE: El calificado posee Partes de Enfermo por Razones de Salud dentro del periodo calificatorio, por tal motivo no puede califcársele 100 puntos en los guarismos de: CARACTER, MANDO Y ESPIRITU POLICIAL.
                        </div>
                      @endif

                      @if (!$situaciones->isEmpty())
                        <div class="alert alert-warning">
                            IMPORTANTE: El calificado posee Disponibilidad o Pasiva dentro del periodo calificatorio, por tal motivo la Honorable Junta Calificaciones va a calificar dentro de ese periodo. Usted debe calificar salteando ese periodo donde el Calificado estuvo en un situación de Pasiva o Disponibilidad.
                        </div>
                      @endif
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="caracter">CARACTER </label> <i class="fas fa-question-circle" title="{{ $ayuda_caracter }}"></i>
                            <input type="number" min="0" max="{{ $max }}" name="caracter" id="caracter" class="form-control" value="{{ old('caracter') }}" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="mando">MANDO </label> <i class="fas fa-question-circle" title="{{ $ayuda_mando }}"></i>
                            <input type="number" min="0" max="{{ $max }}" name="mando" id="mando" class="form-control" value="{{ old('mando') }}" required>
                        </div>
                    </div>

                    <div class="col-md-2 ">
                        <div class="form-group">
                            <label for="espiritu_policial">ESP. POLICIAL </label> <i class="fas fa-question-circle" title="{{ $ayuda_espiritu_policial }}"></i>
                            <input type="number" min="0" max="{{ $max }}" name="espiritu_policial" id="espiritu_policial" class="form-control" value="{{ old('espiritu_policial') }}" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="compromiso_profesional">COMP. PROF. </label> <i class="fas fa-question-circle" title="{{ $ayuda_compromiso_profesional }}"></i>
                            <input type="number" min="0" max="{{ $max }}" name="compromiso_profesional" id="compromiso_profesional" class="form-control" value="{{ old('compromiso_profesional ') }}" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="etica_conducta">ETICA Y COND. </label> <i class="fas fa-question-circle" title="{{ $ayuda_etica_conducta }}"></i>
                            <input type="number" min="0" max="{{ $max }}" name="etica_conducta" id="etica_conducta" class="form-control" value="{{ old('etica_conducta') }}" required>
                        </div>
                    </div>
              </div>

              <div class="form-group">
                <label for="etica_conducta">PROMEDIO:  </label>
                    <output name='resultado' for='caracter mando'> </output>
              </div>


              <div class="form-group">
                <label for="juicio_sintetico">JUICIO SINTETICO   </label> <i class="fas fa-question-circle" title="{{ $ayuda_juicio_sintetico }}"></i>
                    <input type="text" maxlength="360" name="juicio_sintetico" id="juicio_sintetico" class="form-control" value="{{ old('juicio_sintetico') }}" required>
              </div>

              <div class="form-group">
                <label for="estado">ESTADO DE LA CALIFICACION </label> <i class="fas fa-question-circle" title="{{ $ayuda_aprobacion_calificacion }}"></i>
                  <select id="estado" name="estado" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="0">Guardar sin Aprobar la Calificación</option>
                    <option value="1">Guardar y Aprobar la Calificación</option>
                  </select>
              </div>


<!-- Comienza el formulario de Denuncia Completa -->

            <div class="form-group">
                <button class="btn btn-primary">Guardar la Calificación</button>
            </div>
        </form>

        <!-- <table id='denuncias' class="table table-bordered">
            <thead>
                <tr>
                    <th>Apellido</th>
                    <th>Nombres</th>
                    <th>Documento</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table> -->

    </div>
</div>

<!-- Parametros del Periodo Calificatorio Anual -->
<?php
$inicio_anio = date('Y', strtotime('-1 year'));
$fin_anio =  date('Y');

$inicio_periodo = $inicio_anio.'-08-01';
$fin_periodo = $fin_anio.'-07-31';
?>
<!-- Fin -->


<!-- Script DataTable -->
<script>
$(document).ready(function() {
    $('#denuncias').DataTable();
} );
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Script cuanta dias con MomentJS -->
<script src="http://momentjs.com/downloads/moment.js"></script>
<script>

// calcular el tiempo de calificacion
  $("#fecha_hasta").change(function(){
    var fecha_desde = document.getElementById("fecha_desde").value;
    var fecha_hasta = document.getElementById("fecha_hasta").value;

      var desde = moment(fecha_desde);
      var hasta = moment(fecha_hasta);
      var dias = hasta.diff(desde, "days");

      var calificacion_cero = 0;
      var juicio_sintetico_no_califica = "NO CALIFICA POR TIEMPO MINIMO";

  $("#dias").text(dias);

  if (dias <= 60) {
    alert("Días a CALIFICAR: "  + dias + ". Por lo tanto Usted NO califica por tiempo Mínimo. Debe colocar el valor 0 en todos los guarismos de: Caracter, Mando, Espíritu Policial, Compromiso Profesional, Etica y Conducta. Y en el Juicio Sintético deberá escrbir la leyenda: NO CALIFICO POR TIMPO MINIMO. Y la final Guardar la Calificación.");

    document.getElementById("caracter").value = calificacion_cero;
    document.getElementById("mando").value = calificacion_cero;
    document.getElementById("espiritu_policial").value = calificacion_cero;
    document.getElementById("compromiso_profesional").value = calificacion_cero;
    document.getElementById("etica_conducta").value = calificacion_cero;

    document.getElementById("juicio_sintetico").value = juicio_sintetico_no_califica;
  }
});

// calcular el tiempo de calificacion
$("#tipo_calificacion").change(function(){

    var tipo_calificacion = document.getElementById("tipo_calificacion").value;

    var inicio_periodo = "<?php echo $inicio_periodo; ?>";
    var fin_periodo = "<?php echo $fin_periodo; ?>";

  if (tipo_calificacion == "Anual") {
    document.getElementById("fecha_desde").value = inicio_periodo;
    document.getElementById("fecha_hasta").value = fin_periodo;
  }
});
</script>
@endsection
