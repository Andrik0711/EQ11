@extends('layouts.user_type.auth')

@section('content')
    <h1 class=" text-left font-semibold text-sm">Actualizar cliente</h1>

    <div class=" rounded-3xl border-cyan-500 ">
        {{-- Formulario para registrar una categoria --}}
        <form action="{{ route('editar-cliente-update', $cliente->id) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            {{-- Nombre del cliente --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_cliente">Nombre del cliente</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre del cliente" class="form-control" id="nombre_cliente"
                        name="nombre_cliente" value="{{ $cliente->nombre_cliente }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_cliente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Codigo del cliente --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="codigo_cliente">Código del cliente</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Código del cliente" class="form-control" id="codigo_cliente"
                        name="codigo_cliente" value="{{ $cliente->codigo_cliente }}" />

                    {{-- Mensaje de error --}}
                    @error('codigo_cliente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Telefono del cliente --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="telefono_cliente">Teléfono del cliente</label>
                    {{-- Input --}}
                    <input type="number" placeholder="Teléfono del cliente" class="form-control" id="telefono_cliente"
                        name="telefono_cliente" value="{{ $cliente->telefono_cliente }}" />

                    {{-- Mensaje de error --}}
                    @error('telefono_cliente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Email del cliente --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="email_cliente">Email del cliente</label>
                    {{-- Input --}}
                    <input type="email" placeholder="Email del cliente" class="form-control" id="email_cliente"
                        name="email_cliente" value="{{ $cliente->email_cliente }}" />

                    {{-- Mensaje de error --}}
                    @error('email_cliente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Empresa del cliente --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="empresa_cliente">Empresa del cliente</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Empresa del cliente" class="form-control" id="empresa_cliente"
                        name="empresa_cliente" value="{{ $cliente->empresa_cliente }}" />

                    {{-- Mensaje de error --}}
                    @error('empresa_cliente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>



            {{-- Campo oculto el cual pasa el nombre de quien creo al cliente --}}
            <input type="hidden" id="cliente_creado_por" name="cliente_creado_por" value="{{ auth()->user()->name }}">

            {{-- Boton para enviar el registro de categoria --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar Categoria">
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
