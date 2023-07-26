@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Formulario para registrar categorías</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-categorias') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <div class="px-4">
                        {{-- Formulario para registrar una categoría --}}
                        <form action="{{ route('registrar-categoria-store') }}" method="POST" novalidate>
                            @csrf
                            {{-- Nombre de la categoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 for="nombre_categoria">Nombre de la categoría</h6>
                                    <input type="text" placeholder="Nombre de la categoría" class="form-control"
                                        id="nombre_categoria" name="nombre_categoria" value="{{ old('nombre_categoria') }}">
                                    @error('nombre_categoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Código de la categoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 for="codigo_categoria">Código de la categoría</h6>
                                    <input type="text" placeholder="Código de la categoría" class="form-control"
                                        id="codigo_categoria" name="codigo_categoria" value="{{ old('codigo_categoria') }}">
                                    @error('codigo_categoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Descripción de la categoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 for="descripcion_categoria">Descripción de la categoría</h6>
                                    <input type="text" placeholder="Descripción de la categoría" class="form-control"
                                        id="descripcion_categoria" name="descripcion_categoria"
                                        value="{{ old('descripcion_categoria') }}">
                                    @error('descripcion_categoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Campo oculto que pasa el nombre de quien creó la categoría --}}
                            <input type="hidden" id="categoria_creada_por" name="categoria_creada_por"
                                value="{{ auth()->user()->name }}">

                            {{-- Botón para enviar el registro de categoría --}}
                            <button class="btn bg-gradient-success" type="submit"
                                value="Registrar Categoría">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Alerta de éxito --}}
            @if (session('mensaje'))
                <div class="alert alert-success" role="alert">
                    <strong>¡Éxito!</strong> {{ session('mensaje') }}
                </div>
            @endif
        </div>
    </main>
@endsection
