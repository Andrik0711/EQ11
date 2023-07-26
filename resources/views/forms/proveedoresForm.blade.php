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
                        {{-- Formulario para registrar un proveedor --}}
                        <form action="{{ route('registrar-proveedor-store') }}" method="POST" novalidate>

                            @csrf
                            {{-- Nombre del proveedor --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- Label --}}
                                    <h6 for="nombre_proveedor">Nombre del proveedor</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Nombre del proveedor" class="form-control"
                                        id="nombre_proveedor" name="nombre_proveedor"
                                        value="{{ old('nombre_proveedor') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('nombre_proveedor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Codigo del proveedor --}}
                            <div class="col-md-6">
                                <div class="form-group ">
                                    {{-- Label --}}
                                    <h6 for="codigo_proveedor">Código del proveedor</h6>
                                    {{-- Input --}}
                                    <input type="text" placeholder="Código del provedor" class="form-control"
                                        id="codigo_proveedor" name="codigo_proveedor"
                                        value="{{ old('codigo_proveedor') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('codigo_proveedor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Telefono del proveedor --}}
                            <div class="col-md-6">
                                <div class="form-group ">
                                    {{-- Label --}}
                                    <h6 for="telefono_proveedor">Teléfono del proveedor</h6>
                                    {{-- Input --}}
                                    <input type="number" placeholder="Teléfono del provedor" class="form-control"
                                        id="telefono_proveedor" name="telefono_proveedor"
                                        value="{{ old('telefono_proveedor') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('telefono_proveedor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email del proveedor --}}
                            <div class="col-md-6">
                                <div class="form-group ">
                                    {{-- Label --}}
                                    <h6 for="email_proveedor">Email del proveedor</h6>
                                    {{-- Input --}}
                                    <input type="email" placeholder="Email del provedor" class="form-control"
                                        id="email_proveedor" name="email_proveedor" value="{{ old('email_proveedor') }}" />

                                    {{-- Mensaje de error --}}
                                    @error('email_proveedor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
                            <input type="hidden" id="proveedor_creado_por" name="proveedor_creado_por"
                                value="{{ auth()->user()->name }}">

                            {{-- Boton para enviar el registro de categoria --}}
                            <button class="btn bg-gradient-success" type="submit" value="Registrar proveedor">
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
        </div>
    @endsection
