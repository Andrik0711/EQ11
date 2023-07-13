@extends('layouts.user_type.auth')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />

    <style>
        .dropzone {
            border: 2px solid #000000;
            padding: 20px;
            background-color: #f9f9f9;
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dropzone .dz-message {
            text-align: center;
            font-size: 18px;
            color: #7c7c7c;
        }
    </style>
@endsection


@section('content')
    <h1 class="text-left font-semibold text-sm">Actualizar marca</h1>

    {{-- <div>
        <img src="{{ asset('uploads/' . $marca->imagen_marca) }}" alt="Imagen existente" width="200px">
    </div>

    <div>
        <form action="{{ route('editar-imagen-marca', ['id' => $marca->id]) }}" method="POST" enctype="multipart/form-data"
            class="dropzone" id="dropzone">
            @csrf
            @method('PUT')
        </form>
    </div> --}}



    <div class="rounded-3xl border-cyan-500">
        <form action="{{ route('editar-marca-update', ['id' => $marca->id]) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Marca</label>
                    <input type="text" placeholder="Nombre de la marca" class="form-control" id="nombre_marca"
                        name="nombre_marca" value="{{ $marca->nombre_marca }}" />
                    @error('nombre_marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="descripcion_marca">Descripción de la categoría</label>
                    <input type="text" placeholder="Descripción de la marca" class="form-control" id="descripcion_marca"
                        name="descripcion_marca" value="{{ $marca->descripcion_marca }}" />
                    @error('descripcion_marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- <div class="mb-5">
                <input name="imagen" id="imagen" type="hidden" value="{{ $marca->imagen_marca }}" />
            </div> --}}

            <button class="btn bg-gradient-success" type="submit" value="Actualizar marca">Actualizar</button>
        </form>
    </div>


    {{-- Alerta de éxito --}}
    @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> {{ session('mensaje') }}
        </div>
    @endif
@endsection
