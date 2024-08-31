
@extends('template')

@section('title', 'Crear Cliente')

@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #descripcion {
            resize: none;
        }
        #box-razon-social{
            display: none;
        }
    </style>
@endpush


@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4 text-center">Clientes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route ('panel')}}">Inicio</a></li>
                            <li class="breadcrumb-item "><a href="{{route ('clientes.index')}}">Clientes</a></li>
                            <li class="breadcrumb-item active">Crear Clientes</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
                            <form action="{{route('clientes.store')}}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="tipo_persona" class="form-label">Tipo de Cliente:</label>
                                        <select class="form-select" name="tipo_persona" id="tipo_persona">
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="natural" {{old('tipo_persona') == 'natural' ? 'selected' : ''}} >Persona Natural</option>
                                            <option value="jurídica" {{old('tipo_persona') == 'jurídica' ? 'selected' : ''}}>Persona Jurídica</option>
                                        </select>
                                        @error('tipo_persona')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-2" id="box-razon-social">
                                        <label  id="label-natural" for="razon_social" class="form-label">Nombres y Apellidos</label>
                                        <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa</label>

                                        <input type="text" name="razon_social" class="form-control" id="razon_social" value="{{old('razon_social')}}">
                                        @error('razon_social')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label  id="direccion" for="direccion" class="form-label">Direccion</label>
                                        <input type="text" name="direccion" class="form-control" id="direccion" value="{{old('direccion')}}">
                                        @error('direccion')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="documento_id" class="form-label">Tipo de Documento:</label>
                                        <select class="form-select" name="documento_id" id="documento_id">
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            @foreach ($documentos as $item)
                                            <option value="{{$item->id}}" {{old('documento_id') == $item->id ? 'selected' : ''}}>{{$item->tipo_documento}}</option>
                                            @endforeach
                                        </select>
                                    
                                        @error('documento_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label  id="numero_documento" for="numero_documento" class="form-label">Numero de Documento</label>
                                        <input type="text" name="numero_documento" class="form-control" id="numero_documento" value="{{old('numero_documento')}}">
                                        @error('numero_documento')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#tipo_persona').on('change', function(){
                let selectValue = $(this).val();
                if(selectValue == 'natural') {
                    $('#label-juridica').hide();
                    $('#label-natural').show();

                } else {
                    $('#label-natural').hide();
                    $('#label-juridica').show();

                }

                $('#box-razon-social').show();
            })
        })
    </script>
@endpush