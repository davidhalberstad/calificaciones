@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Editar Usuario</div>

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
        <form action="" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
            <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" readonly value="{{ $user->email }}">
            </div>

            <div class="form-group">
            <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="form-group">
            <label for="password">Clave <em>(Ingresar tan solo cuando se desea modificar la clave)</em></label>
                <input type="text" name="password" class="form-control" value="{{ $user->password }}">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Guardar Usuario</button>
            </div>
        </form>

        <div class="row">
            <div class="col-md-4">
                <select name="" class="form-control" id="select-project">
                    <option value="">Seleccione Nivel</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
             </div>
            <div class="col-md-4">
                <select name="" class="form-control" id="select-level">
                    <option value="">Seleccione Nivel</option>
                </select>
             </div>
             <div class="col-md-4">
                <button class="btn btn-primary btn-block">Asignar Proyecto</button>
             </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Nivel</th>
                    <th>Opciones</th>
                </tr>
            </thead> 
            <tbody>
                <tr>
                    <td>Proyecto A</td>
                    <td>N1</td>
                    <td>
                        <a href="usuario/{{ $user->id }}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="usuario/{{ $user->id }}/eliminar" class="btn btn-sm  btn-danger">Dar de Baja</a>
                    </td>
                </tr>
            </tbody>
        </table>       

    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection