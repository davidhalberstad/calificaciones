@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Editar Calificaciones</div>

    <div class="panel-body">
            @if(session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
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

                <tr>
                  <td>{{ $calificado->revista }}</td>
                  <td>{{ $calificado->jerarquia }}</td>
                  <td>{{ $calificado->apellido }}</td>
                  <td>{{ $calificado->nombres }}</td>
                  <td>{{ $calificado->dependencia }}</td>
<input id="revista" name="revista" type="hidden" value="{{ $calificado->revista }}">
<input id="jerarquia" name="jerarquia" type="hidden" value="{{ $calificado->jerarquia }}">
<input id="apellido" name="apellido" type="hidden" value="{{ $calificado->apellido }}">
<input id="nombres" name="nombres" type="hidden" value="{{ $calificado->nombres }}">
<input id="dependencia_calificado" name="dependencia_calificado" type="hidden" value="{{ $calificado->dependencia }}">
                </tr>

            </tbody>

        </table>
      </div>
</div>

<!-- datos del calificador -->
<input id="revista_calificador" name="revista_calificador" type="hidden" value="{{ $calificado->revista_calificador }}">
<input id="jerarquia_calificador" name="jerarquia_calificador" type="hidden" value="{{ $calificado->jerarquia_calificador }}">
<input id="apellido_calificador" name="apellido_calificador" type="hidden" value="{{ $calificado->apellido_calificador }}">
<input id="nombres_calificador" name="nombres_calificador" type="hidden" value="{{ $calificado->nombres_calificador }}">
<input id="dependencia" name="dependencia" type="hidden" value="{{ $calificado->dependencia }}">


<!-- Calificaciones  -->
<div class="container">
    @php
      $fila = 1
    @endphp
      <div class="row">
          <div class="col-xs-12">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h5>
                        <strong>
                          <p>Calificador:
                          {{ $calificado->jerarquia_calificador }}  {{ $calificado->nombres_calificador }}  {{ $calificado->apellido_calificador }}</p>
                        </strong>
                      </h5>
                  </div>
                  <div class="panel-body">
                    <h5><u>Tipo Calificación:</u> {{ $calificado->tipo_calificacion }} - <u>Fecha Desde:</u> {{ \Carbon\Carbon::parse($calificado->fecha_desde)->format('d-m-Y') }} - <u>Fecha Hasta:</u> {{ \Carbon\Carbon::parse($calificado->fecha_hasta)->format('d-m-Y') }}</h5></br>
                    <h5><u>CARÁCTER:</u> {{ $calificado->caracter }} - <u>MANDO:</u> {{ $calificado->mando }} - <u>ESPÍRITU POLICIAL:</u> {{ $calificado->espiritu_policial }} - <u>COMPROMISO PROFESIONAL:</u> {{ $calificado->compromiso_profesional }} - <u>ÉTICA Y CONDUCTA:</u> {{ $calificado->etica_conducta }}</h5></br>
                    <h5><strong><u>PROMEDIO:</u> {{ $calificado->promedio }} </strong></h5></br>
                    <h5><u>JUICIO SINTÉTICO:</u> {{ $calificado->juicio_sintetico }} </h5></br>
                  </div>
              </div>
          </div>
      </div>
</div>
<!--  Fin  -->

              <div class="form-group">
                <label for="fecha_notificacion">FECHA DE NOTIFICACION  </label>
                    <input type="date" name="fecha_notificacion" class="form-control" value="{{ $calificado->fecha_notificacion }}" required>
              </div>

              

<!-- Comienza el formulario de Denuncia Completa -->

            <div class="form-group">
                <button class="btn btn-primary">Guardar Notificación</button>
            </div>
        </form>

    </div>
</div>

@endsection
