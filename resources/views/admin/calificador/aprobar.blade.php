@extends('layouts.app')

@section('content')
<style rel="stylesheet">
  body {
    overflow-x: hidden;
  }
</style>
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
<!-- DataTables -->
<!-- CUSTOM STYLE  -->
<link href="assets/css/style.css" rel="stylesheet" />
<link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css' />

<div class="row">
  <div class="container">
    <h1>Aprobar</h1>
  </div>
</div>

<div class="row">
      <div class="container">
        <table id="example" class="table table-bordered table-striped table-hover" >
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="10%">Revista</th>
                    <th width="10%">Jerarquia</th>
                    <th width="15%">Apellido</th>
                    <th width="15%">Nombre</th>
                    <th width="10%">Desde</th>
                    <th width="10%">Hasta</th>
                    <th width="10%">Promedio</th>
                    <th width="5%">Opciones</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($calificaciones_realizadas as $value)
                <tr>
                  <td>{{ $value->id }}</td>
                  <td>{{ $value->revista }}</td>
                  <td>{{ $value->jerarquia }}</td>
                  <td>{{ $value->apellido }}</td>
                  <td>{{ $value->nombres }}</td>
                  <td>{{ $value->fecha_desde }}</td>
                  <td>{{ $value->fecha_hasta }}</td>
                  <td>{{ $value->promedio }}</td>
                  <td>
                    @if($value->aprobado == 0)
                      <a href="{{ route('edit', $value->id) }}"><i class="fas fa-file-signature" title="Aprobar"></i></a>
                      <a href="{{ route('reporte_calificacion', $value->id) }}" target="_blank"><i class="fas fa-file-alt" title="Ver Calificación"></i></a>
                    @else
                      <a href="{{ route('reporte_calificacion', $value->id) }}" target="_blank"><i class="fas fa-file-alt" title="Ver Calificación"></i></a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>

        </table>
      </div>
</div>

<!-- DataTables -->
<!-- inicio data table  -->
<script src='https://code.jquery.com/jquery-3.3.1.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js'></script>
<script>
  $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
  } );
</script>
<!-- fin data table  -->

<!-- Script DataTable -->
<!-- <script>
$(document).ready(function() {
      $('#calificaciones').DataTable( {
        data: data
    });
        // Lenguaje en Castellano de la tabla
        "language":{
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
            },
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              },
              "buttons": {
                  "copy": "Copiar",
                  "colvis": "Visibilidad"
              },

        });
});
</script> -->
@endsection
