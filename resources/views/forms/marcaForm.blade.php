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
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Formulario para registrar marcas</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-marcas') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <div class="px-4">
                        <form action="{{ route('marca-image-store') }}" method="POST" enctype="multipart/form-data"
                            id="dropzone"
                            class="dropzone border-dashed border-2 w-20 h-96 rounded flex justify-center items-center align-middle">
                            @csrf

                        </form>

                        {{-- Formulario para registrar una categoria --}}
                        <form action="{{ route('registrar-marca-store') }}" method="POST" novalidate>

                            @csrf
                            {{-- Nombre de la marca --}}
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    {{-- Label --}}
                                    <h6 for="nombre_marca">Nombre de la Marca</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Nombre de la Marca" class="form-control"
                                        id="nombre_marca" name="nombre_marca" value="{{ old('nombre_marca') }}" />

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
                                    <h6 for="descripcion_marca">Descripción de la Marca</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Descripción de la Marca" class="form-control"
                                        id="descripcion_marca" name="descripcion_marca"
                                        value="{{ old('descripcion_marca') }}" />

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
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                        {{ $message }} </p>
                                @enderror
                            </div>


                            {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
                            <input type="hidden" id="marca_creada_por" name="marca_creada_por"
                                value="{{ auth()->user()->name }}">

                            {{-- Boton para enviar el registro de sub categoria --}}
                            <button class="btn bg-gradient-success" type="submit" value="Registrar Marca">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Alerta de éxito --}}
            @if (session('mensaje'))
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> {{ session('mensaje') }}
                </div>
            @endif
        </div>
    </main>
@endsection
