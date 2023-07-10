@extends('layouts.user_type.auth')

@section('content')
    <h1 class=" text-left font-semibold text-sm">Formulario de categoria</h1>

    <div class=" rounded-3xl border-cyan-500 ">
        {{-- Formulario para registrar una categoria --}}
        <form action="" method="" novalidate>

            @csrf
            {{-- Nombre de la categoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_categoria">Nombre de la categoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre de la categoria" class="form-control" id="nombre_categoria"
                        name="nombre_categoria" value="{{ old('nombre_categoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_categoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Codigo de la categoria --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="codigo_categoria">Código de la categoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Código de la categoria" class="form-control" id="codigo_categoria"
                        name="codigo_categoria" value="{{ old('codigo_categoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('codigo_categoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Descripcion de la categoria --}}
            <div class="col-md-6">
                <div class="form-group ">
                    {{-- Label --}}
                    <label for="descripcion_categoria">Descripción de la categoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción de la categoria" class="form-control"
                        id="descripcion_categoria" name="descripcion_categoria"
                        value="{{ old('descripcion_categoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_categoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            {{-- Boton para enviar el registro de categoria --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar Categoria">
                Enviar
            </button>


        </form>
    </div>
@endsection
