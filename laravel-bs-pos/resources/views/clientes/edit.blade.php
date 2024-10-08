
@extends('template')

@section('title', 'Editar Clientes')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #descripcion {
            resize: none;
        }
    </style>
@endpush


@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4 text-center">Editar Cliente</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route ('panel')}}">Inicio</a></li>
                            <li class="breadcrumb-item "><a href="{{route ('clientes.index')}}">Clientes</a></li>
                            <li class="breadcrumb-item active">Editar Clientes</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
                            <form action="{{route('clientes.update', ['cliente' => $cliente])}}" method="post">
                            @method('PATCH')  
                            @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombre:</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre', $cliente->nombre)}}">
                                        @error('nombre')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="descripcion" class="form-label">Descripcion:</label>
                                        <textarea rows="3" name="descripcion" class="form-control" id="descripcion">{{ old('descripcion', $cliente->descripcion)}}</textarea>
                                        @error('descripcion')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        <button type="reset" class="btn btn-secondary">Reiniciar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
@endpush