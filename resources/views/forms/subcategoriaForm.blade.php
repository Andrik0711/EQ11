@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Formulario para registrar proveedores</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-proveedores') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <div class="px-4">
                        {{-- Formulario para registrar una subcategoría --}}
                        <form action="{{ route('registrar-subcategoria-store') }}" method="POST" novalidate>
                            @csrf

                            {{-- Selección de la categoría padre --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- Label --}}
                                    <h6 for="categoria_subcategoria">Seleccione una categoría</h6>
                                    {{-- Select --}}
                                    <select class="form-control" id="categoria_subcategoria" name="categoria_subcategoria">
                                        <option value="">Seleccione una categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                        @endforeach
                                    </select>

                                    {{-- Mensaje de error --}}
                                    @error('categoria_subcategoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Código de la subcategoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- Label --}}
                                    <h6 for="codigo_subcategoria">Código de Subcategoría</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Código de Subcategoría" class="form-control"
                                        id="codigo_subcategoria" name="codigo_subcategoria"
                                        value="{{ old('codigo_subcategoria') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('codigo_subcategoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Nombre de la subcategoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- Label --}}
                                    <h6 for="nombre_subcategoria">Nombre de la Subcategoría</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Nombre de Subcategoría" class="form-control"
                                        id="nombre_subcategoria" name="nombre_subcategoria"
                                        value="{{ old('nombre_subcategoria') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('nombre_subcategoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Descripción de la subcategoría --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- Label --}}
                                    <h6 for="descripcion_subcategoria">Descripción de la Subcategoría</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Descripción de Subcategoría" class="form-control"
                                        id="descripcion_subcategoria" name="descripcion_subcategoria"
                                        value="{{ old('descripcion_subcategoria') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('descripcion_subcategoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Campo oculto para saber quién la creó --}}
                            <input type="hidden" id="subcategoria_creada_por" name="subcategoria_creada_por"
                                value="{{ auth()->user()->name }}">

                            {{-- Boton para enviar el registro de subcategoría --}}
                            <button class="btn bg-gradient-success" type="submit" value="Registrar Subcategoría">
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
