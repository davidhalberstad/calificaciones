@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Usuarios</div>
    
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
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
            <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
            <label for="password">Clave</label>
                <input type="text" name="password" class="form-control" value="{{ old('password', str_random(8)) }}">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Registrar Usuario</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>E-mail</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead> 
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="usuario/{{ $user->id }}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="usuario/{{ $user->id }}/eliminar" class="btn btn-sm  btn-danger">Dar de Baja</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>       

    </div>
</div>
@endsection
