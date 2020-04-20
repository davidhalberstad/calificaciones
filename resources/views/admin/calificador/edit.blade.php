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


              <!-- Periodo calificatorio -->
              <hr> </hr>
              <div class="form-group">
                  <h3>*Periodo Calificatorio* </h3>
              </div>

              <div class="form-group">
                <label for="fecha_desde">Fecha Desde  </label>
                    <input type="date" name="fecha_desde" class="form-control" value="{{ $calificado->fecha_desde }}" required>
              </div>

              <div class="form-group">
                <label for="fecha_hasta">Fecha Hasta  </label>
                    <input type="date" name="fecha_hasta" class="form-control" value="{{ $calificado->fecha_hasta }}"required>
              </div>

              <div class="form-group">
                <label for="tipo_calificacion">Motivo de la Calificación  </label>
                    <input type="text" name="tipo_calificacion" class="form-control" value="{{ $calificado->tipo_calificacion }}" required>
              </div>

              <!-- Calificacion  -->
              <hr> </hr>
              <div class="form-group">
                  <h3>*Calificación* </h3>
              </div>

              <div class="form-group">
                <label for="caracter">CARACTER  </label>
                    <input type="number" min='0' max='100' name="caracter" class="form-control" value="{{ $calificado->caracter }}" required>
              </div>

              <div class="form-group">
                <label for="mando">MANDO  </label>
                    <input type="number" min='0' max='100' name="mando" class="form-control" value="{{ $calificado->mando }}" required>
              </div>

              <div class="form-group">
                <label for="espiritu_policial">ESPIRITU POLICIAL  </label>
                    <input type="number" min='0' max='100' name="espiritu_policial" class="form-control" value="{{ $calificado->espiritu_policial }}" required>
              </div>

              <div class="form-group">
                <label for="compromiso_profesional">COMPROMISO PROFESIONAL  </label>
                    <input type="number" min='0' max='100' name="compromiso_profesional" class="form-control" value="{{ $calificado->compromiso_profesional }}" required>
              </div>

              <div class="form-group">
                <label for="etica_conducta">ETICA Y CONDUCTA  </label>
                    <input type="number" min='0' max='100' name="etica_conducta" class="form-control" value="{{ $calificado->etica_conducta }}" required>
              </div>

              <div class="form-group">
                <label for="etica_conducta">PROMEDIO:  </label>
                    <output name='resultado' for='caracter mando'> </output>
              </div>


              <div class="form-group">
                <label for="juicio_sintetico">JUICIO SINTETICO   </label>
                    <input type="text" maxlength="140" name="juicio_sintetico" class="form-control" value="{{ $calificado->juicio_sintetico }}" required>
              </div>

              <div class="form-group">
                <label for="estado">ESTADO DE LA CALIFICACION </label>
                  <select id="estado" name="estado" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="0">Guardar sin Aprobar la Calificación</option>
                    <option value="1">Guardar y Aprobar la Calificación</option>
                  </select>
              </div>



<!-- Comienza el formulario de Denuncia Completa -->

            <div class="form-group">
                <button class="btn btn-primary">Modificar</button>
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

<!-- Script DataTable -->
<script>
$(document).ready(function() {
    $('#denuncias').DataTable();
} );
</script>
@endsection
