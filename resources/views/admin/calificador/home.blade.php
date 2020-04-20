@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
<h1>Panel de Control</h1>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $calificaciones_realizadas }}</h3>

        <p>Ver Mis Registros Cargados</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{ url('visualizar') }}" class="small-box-footer">Ampliar Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $calificaciones_sin_aprobar }}</h3>

        <p>Calificaciones pendientes de ser Aprobadas</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{ url('aprobar') }}" class="small-box-footer">Ampliar info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $calificaciones_sin_notificar }}</h3>

        <p>Calificaciones Pendientes para Notificar</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ url('notificar') }}" class="small-box-footer">Ampliar info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

  <!-- ./col -->
  <!-- <div class="row">
    <canvas id="myChart2" width="400" height="400"></canvas>
  </div> -->
  <!-- <div class="row">
    <canvas id="myChart" width="400" height="400"></canvas>
  </div> -->
</div>
<!-- /.row -->


<!-- Garficos Charts.js-->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


@endsection
