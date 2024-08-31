
@extends('template')

@section('title', 'Clientes')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@if (session('success'))
<script>

let message = "{{session('success') }}";
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: message
});
</script>
@endif


<div class="container-fluid px-4">
                        <h1 class="mt-4 text-center">Clientes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route ('panel')}}">Inicio</a></li>
                            <li class="breadcrumb-item active">Clientes</li>
                        </ol>

                        <div class="mb-4">
                            <a href="{{route ('clientes.create')}}"><button type="button" class="btn btn-primary">Añadir nuevo registro</button></a>
                        </div>                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Clientes
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                    
                                        <tr>
                                            <td>
                                                {{$cliente->nombre}}
                                            </td>
                                            <td>
                                                {{$cliente->descripcion}}
                                            </td>
                                            <td>
                                                @if ($cliente->estado == 1)                                                
                                                    <span class="fw-bolder rounded bg-success text-white p-1">Activo</span>
                                                @else
                                                    <span class="fw-bolder rounded bg-danger text-white p-1">Eliminado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <form action="{{route ('clientes.edit',['cliente' => $cliente] )}}" method="get">
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                </form>
                                                @if ($cliente->estado == 1)                                                
                                                <button type="button" class="btn btn-danger" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cliente->id}}">>Eliminar</button>
                                                @else
                                                <button type="button" class="btn btn-success" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cliente->id}}">>Restaurar</button>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="confirmModal-{{$cliente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $cliente->estado == 1 ? "¿Desea eliminar el cliente {$cliente->nombre}?" : "¿Desea restaurar el cliente {$cliente->nombre}?" }}
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <form action="{{route('clientes.destroy', ['cliente'=>$cliente->id])}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    @if ($cliente->estado == 1)                                                
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                @else
                                                    <button type="submit" class="btn btn-success">Restaurar</button>
                                                @endif
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js')}}"></script>
@endpush