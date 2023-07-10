@extends('layouts.user_type.auth')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('styles-dropzone')
    <style>
        input:focus {
            outline-color: #5e72e4;
        }

        textarea:focus {
            outline-color: #5e72e4;
        }

        input {
            border-radius: 20px;
        }

        .mb-5 label {
            margin-bottom: 0.5rem;

        }

        .dropzone.dz-clickable .dz-message,
        .dropzone.dz-clickable .dz-message * {
            width: 400px !important;
        }
    </style>
@endsection

@section('content')
    <h1 class="text-left font-semibold text-sm">Formulario de registro de Marca</h1>



    <div class="card-body px-4 pt-4 pb-2 flex items-center justify-center text-center">

        {{-- Formulario de dropzone --}}
        <form action="{{ route('marca-image-store') }}" method="post" enctype="multipart/form-data" id="dropzone"
            class="dropzone border-dashed border-2 w-80 h-36 rounded"
            style="width: 100%; border:none;padding:0px; align-items:center">
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

            <div class="mb-5">
                <input name="imagen" id="imagen" type="hidden" value="{{ old('value') }}" />
            </div>

            @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
            @enderror

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
