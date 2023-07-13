@extends('layouts.user_type.auth')

@push('styles')
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
@endpush

@section('content')
    <h1 class="text-left font-semibold text-sm">Formulario de registro de Marca</h1>



    <div class="px-1">
        <form action="{{ route('marca-image-store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
            class="dropzone border-dashed border-2 w-20 h-96 rounded flex justify-center items-center align-middle">
            @csrf

        </form>

        {{-- Formulario para registrar una categoria --}}
        <form action="{{ route('registrar-marca-store') }}" method="POST" novalidate>

            @csrf
            {{-- Nombre de la marca --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_marca">Nombre de la Marca</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre de la Marca" class="form-control" id="nombre_marca"
                        name="nombre_marca" value="{{ old('nombre_marca') }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            {{-- Descripcion de marca --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="descripcion_marca">Descripción de la Marca</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción de la Marca" class="form-control" id="descripcion_marca"
                        name="descripcion_marca" value="{{ old('descripcion_marca') }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo oculto para la imagen --}}
            <div class="col-md-6">
                <input name="imagen" id="imagen" type="hidden" value="{{ old('value') }}" />
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                @enderror
            </div>


            {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
            <input type="hidden" id="marca_creada_por" name="marca_creada_por" value="{{ auth()->user()->name }}">

            {{-- Boton para enviar el registro de sub categoria --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar Marca">
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
