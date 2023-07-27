@extends('layouts.user_type.auth')

@section('title', 'Actualizar marca')


@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
@endpush


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
                    <div class="px-4 flex">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <form action="{{ route('editar-marca-update', ['id' => $marca->id]) }}" method="POST"
                                        novalidate>
                                        @csrf
                                        @method('PUT')

                                        {{-- Nombre de la marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="nombre_marca">Nombre de la Marca</h6>
                                                <input type="text" placeholder="Nombre de la Marca" class="form-control"
                                                    id="nombre_marca" name="nombre_marca"
                                                    value="{{ $marca->nombre_marca }}" />
                                                @error('nombre_marca')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Descripcion de marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="descripcion_marca">Descripción de la Marca</h6>
                                                <input type="text" placeholder="Descripción de la Marca"
                                                    class="form-control" id="descripcion_marca" name="descripcion_marca"
                                                    value="{{ $marca->descripcion_marca }}" />
                                                @error('descripcion_marca')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Imagen actual de la marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Imagen actual</h6>
                                                <div
                                                    class=" d-flex justify-content-center items-content-center align-middle">
                                                    <img class="border-radius-lg"
                                                        src="{{ asset('uploads/' . $marca->imagen_marca) }}"
                                                        alt="imagen actual de la marca" width="150">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Campo oculto para la imagen actual (si deseas mantener la imagen actual) --}}
                                        <input type="hidden" name="imagen_actual" value="{{ $marca->imagen_marca }}" />

                                        {{-- Campo oculto para la imagen nueva --}}
                                        <div class="col-md-6">
                                            <input name="imagen" id="imagen" type="hidden"
                                                value="{{ old('value') }}" />
                                            @error('imagen')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <button class="btn bg-gradient-success" type="submit"
                                            value="Actualizar marca">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group">
                                    <h6>Actualizar imagen</h6>
                                    <form action="{{ route('marca-image-store') }}" method="POST"
                                        enctype="multipart/form-data" id="cargar_imagen"
                                        class="dropzone d-flex justify-content-center items-content-center align-middle border border-success">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
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
