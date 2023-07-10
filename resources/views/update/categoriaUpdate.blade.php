@extends('layouts.user_type.auth')

@section('content')
    <h1 class="text-left font-semibold text-sm">Actualizar categoría</h1>

    <div class="rounded-3xl border-cyan-500">
        {{-- Formulario para actualizar una categoría --}}
        <form action="{{ route('editar-categoria-update', ['id' => $categoria->id]) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Nombre de la categoría --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_categoria">Nombre de la categoría</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre de la categoría" class="form-control" id="nombre_categoria"
                        name="nombre_categoria" value="{{ $categoria->nombre_categoria }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_categoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Código de la categoría --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="codigo_categoria">Código de la categoría</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Código de la categoría" class="form-control" id="codigo_categoria"
                        name="codigo_categoria" value="{{ $categoria->codigo_categoria }}" />

                    {{-- Mensaje de error --}}
                    @error('codigo_categoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Descripción de la categoría --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="descripcion_categoria">Descripción de la categoría</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción de la categoría" class="form-control"
                        id="descripcion_categoria" name="descripcion_categoria"
                        value="{{ $categoria->descripcion_categoria }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_categoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo oculto que pasa el nombre de quien creó la categoría --}}
            <input type="hidden" id="categoria_creada_por" name="categoria_creada_por"
                value="{{ $categoria->categoria_creada_por }}">

            {{-- Boton para enviar la actualización de categoría --}}
            <button class="btn bg-gradient-success" type="submit" value="Actualizar Categoría">
                Enviar
            </button>
        </form>
    </div>

    {{-- Alerta de éxito --}}
    @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> {{ session('mensaje') }}
        </div>
    @endif
@endsection
