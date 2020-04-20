@if(auth()->check())
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Panel de Control del Calificador -->
    @if(auth()->user()->is_admin)
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Modulo Calificador
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="{{ url('consulta_calificador_calificado') }}" class="nav-link {{ ! Route::is('consulta_calificador_calificado') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Alta</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('editar') }}" class="nav-link {{ ! Route::is('editar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Editar</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('aprobar') }}" class="nav-link {{ ! Route::is('aprobar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Aprobar</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('notificar') }}" class="nav-link {{ ! Route::is('notificar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Notificar</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('visualizar') }}" class="nav-link {{ ! Route::is('visualizar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Totalidad</p>
          </a>
        </li>

      </ul>
    </li>

    <!-- inicio modulo -->
    <li class="nav-item has-treeview menu-closed">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Modulo Dir. Gral. RRHH
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="{{ url('consulta_calificador_calificado') }}" class="nav-link {{ ! Route::is('consulta_calificador_calificado') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Alta</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('editar') }}" class="nav-link {{ ! Route::is('editar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Editar</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('aprobar') }}" class="nav-link {{ ! Route::is('aprobar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Aprobar</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('notificar') }}" class="nav-link {{ ! Route::is('notificar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Notificar</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('visualizar') }}" class="nav-link {{ ! Route::is('visualizar') ?: 'active' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Totalidad</p>
          </a>
        </li>

      </ul>
    </li>
    @endif

  </ul>
</nav>
@endif
