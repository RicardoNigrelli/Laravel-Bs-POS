
@extends('template')

@section('title', 'Editar Productos')

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
                        <h1 class="mt-4 text-center">Productos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route ('panel')}}">Inicio</a></li>
                            <li class="breadcrumb-item "><a href="{{route ('productos.index')}}">Productos</a></li>
                            <li class="breadcrumb-item active">Editar Productos</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
                            <form action="{{route('productos.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="codigo" class="form-label">Código:</label>
                                        <input type="text" name="codigo" class="form-control" id="codigo" value="{{old('codigo', $producto->codigo)}}">
                                        @error('codigo')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombre:</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre', $producto->nombre)}}">
                                        @error('nombre')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="descripcion" class="form-label">Descripcion:</label>
                                        <textarea rows="3" name="descripcion" class="form-control" id="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                        @error('descripcion')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento:</label>
                                        <input type="date" name="fecha_vencimiento" class="form-control" id="fecha_vencimiento" value="{{old('fecha_vencimiento', $producto->fecha_vencimiento)}}">
                                        @error('fecha_vencimiento')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="img_path" class="form-label">Imagen:</label>
                                        <input type="file" name="img_path" class="form-control" id="img_path" value="{{old('img_path', $producto->img_path)}}" accept="Image/*">
                                        @error('img_path')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                      <div class="col-md-6">
                                        <label for="marca_id" class="form-label">Marca:</label>
                                        <select name="marca_id" id="marca_id" class="form-control">
                                            <option value="" disabled selected>Sin marca seleccionada</option>

                                            @foreach ($marcas as $item)
                                            @if ($producto->marca_id == $item->id)
                                            <option selected value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                            @else
                                            <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('marca_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="presentacione_id" class="form-label">Presentaciones:</label>
                                        <select name="presentacione_id" id="presentacione_id" class="form-control">
                                            <option value="" disabled selected>Sin presentación seleccionada</option>
                                            @foreach ($presentaciones as $item)
                                            @if ($producto->presentacione_id == $item->id)
                                            <option selected value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                            @else
                                            <option value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('presentacione_id')
                                        <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categorias" class="form-label">Categorías:</label>
                                        <div id="categorias">
                                            @foreach ($categorias as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="categorias[]" id="categoria{{ $item->id }}" value="{{ $item->id }}"
                                                        @if(in_array($item->id, old('categorias', $producto->categorias->pluck('id')->toArray()))) checked @endif>
                                                    <label class="form-check-label" for="categoria{{ $item->id }}">
                                                        {{ $item->nombre }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('categorias')
                                            <small class="text-danger">{{ '*' . $message }}</small>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
@endpush