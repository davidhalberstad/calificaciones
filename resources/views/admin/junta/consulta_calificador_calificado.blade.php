@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Buscador</div>

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
          <h1>Escriba el Nro. de Revista del Calificado</h1>
        </div>
      </div>

      <div class="row">
            <div class="container">
              <table id="example" class="table table-bordered table-striped table-hover" >
                  <thead>
                      <tr>
                          <th width="10%">Revista</th>
                          <th width="15%">Jerarquia</th>
                          <th width="20%">Apellido</th>
                          <th width="20%">Nombres</th>
                          <th width="30%">Dependencia</th>
                          <th width="10%">Opciones</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($policias as $value)
                      <tr>
                        <td>{{ $value->revista }}</td>
                        <td>{{ $value->jerarquia }}</td>
                        <td>{{ $value->apellido }}</td>
                        <td>{{ $value->nombres }}</td>
                        <td>{{ $value->dependencia }}</td>
                        <td>
                          <a href="{{ route('calificaciones', $value->revista) }}"><i class="fas fa-list-ol" title="Calificar"></i></a>
                          <!-- <a href="{{ route('print', $value->revista) }}" target="_blank"><i class="fas fa-file-pdf" title="PDF"></i></a>
                          <a href="{{ route('reporte_calificacion', $value->revista) }}" target="_blank"><i class="fas fa-file-alt" title="Ver Calificacion"></i></a> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>

              </table>
            </div>
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

@endsection
