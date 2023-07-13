@extends('layouts.user_type.auth')

@section('content')
    <h1 class=" text-left font-semibold text-sm">Formulario de categoria</h1>

    <div class=" rounded-3xl border-cyan-500 ">
        {{-- Formulario para registrar un proveedor --}}
        <form action="{{ route('editar-proveedor-update', $proveedor->id) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            {{-- Nombre del proveedor --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_proveedor">Nombre del proveedor</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre del proveedor" class="form-control" id="nombre_proveedor"
                        name="nombre_proveedor" value="{{ $proveedor->nombre_proveedor }}" />

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
                    <label for="codigo_proveedor">Código del proveedor</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Código del provedor" class="form-control" id="codigo_proveedor"
                        name="codigo_proveedor" value="{{ $proveedor->codigo_proveedor }}" />

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
                    <label for="telefono_proveedor">Teléfono del proveedor</label>
                    {{-- Input --}}
                    <input type="number" placeholder="Teléfono del provedor" class="form-control" id="telefono_proveedor"
                        name="telefono_proveedor" value="{{ $proveedor->telefono_proveedor }}" />

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
                    <label for="email_proveedor">Email del proveedor</label>
                    {{-- Input --}}
                    <input type="email" placeholder="Email del provedor" class="form-control" id="email_proveedor"
                        name="email_proveedor" value="{{ $proveedor->email_proveedor }}" />

                    {{-- Mensaje de error --}}
                    @error('email_proveedor')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>



            {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
            <input type="hidden" id="proveedor_creado_por" name="proveedor_creado_por" value="{{ auth()->user()->name }}">

            {{-- Boton para enviar el registro de categoria --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar proveedor">
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
