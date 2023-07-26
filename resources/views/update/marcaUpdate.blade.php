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
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Actualizar marca</h6>
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
                        <form action="{{ route('editar-marca-update', ['id' => $marca->id]) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 for="nombre_marca">Nombre de la Marca</h6>
                                    <input type="text" placeholder="Nombre de la marca" class="form-control"
                                        id="nombre_marca" name="nombre_marca" value="{{ $marca->nombre_marca }}" />
                                    @error('nombre_marca')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 for="descripcion_marca">Descripción de la categoría</h6>
                                    <input type="text" placeholder="Descripción de la marca" class="form-control"
                                        id="descripcion_marca" name="descripcion_marca"
                                        value="{{ $marca->descripcion_marca }}" />
                                    @error('descripcion_marca')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="mb-5">
                <input name="imagen" id="imagen" type="hidden" value="{{ $marca->imagen_marca }}" />
            </div> --}}

                            <button class="btn bg-gradient-success" type="submit"
                                value="Actualizar marca">Actualizar</button>
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
