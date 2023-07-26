@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Actualizar categoría</h6>
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
                        {{-- Formulario para actualizar una categoría --}}
                        <form action="{{ route('editar-categoria-update', ['id' => $categoria->id]) }}" method="POST"
                            novalidate>
                            @csrf
                            @method('PUT')

                            {{-- Nombre de la categoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- Label --}}
                                    <h6 for="nombre_categoria">Nombre de la categoría</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Nombre de la categoría" class="form-control"
                                        id="nombre_categoria" name="nombre_categoria"
                                        value="{{ $categoria->nombre_categoria }}" />

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
                                    <h6 for="codigo_categoria">Código de la categoría</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Código de la categoría" class="form-control"
                                        id="codigo_categoria" name="codigo_categoria"
                                        value="{{ $categoria->codigo_categoria }}" />

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
                                    <h6 for="descripcion_categoria">Descripción de la categoría</h6>
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
