@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
@stop



@section('content')
   {{--  <div class="card">
        
    </div> --}}

    <div class="card">
        <div class="card-header ">
            <a href="{{ route('users.crear') }}" class="btn  btn-warning btn-lg">Crear Usuario</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de usuario</th>
                        <th>Correo electronico</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->getRoleNames()[0] }}</td>
                            <td>
                                <form action="{{route('users.delete', $usuario)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('users.edit',$usuario)}}" class="btn btn-dark btn-sm">Editar<a>
                                    {{-- @can('editar usuario')
                                    @endcan --}}
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿ESTÁ SEGURO DE BORRAR?')" value="Borrar">Eliminar</button> 
                                    {{-- @can('eliminar usuario')
                                    @endcan --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#example').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json',
            },  
        });
        
    </script>
@stop