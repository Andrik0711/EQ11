@extends('layouts.user_type.auth')

@section('content')
    <h1 class=" text-left font-semibold text-sm">Formulario de sub categoria</h1>

    <div class=" rounded-3xl border-cyan-500 ">
        {{-- Formulario para registrar una categoria --}}
        <form action="" method="" novalidate>

            @csrf
            {{-- Seleccion de la categoria padre --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="">Seleccione una categoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Seleccione una categoria" class="form-control" id=""
                        name="" value="{{ old('') }}" />

                    {{-- Mensaje de error --}}
                    @error('')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Codigo de la sub categoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="codigo_subcategoria">Codigo de Subcategoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Codigo de Subcategoria" class="form-control" id="codigo_subcategoria"
                        name="codigo_subcategoria" value="{{ old('codigo_subcategoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('codigo_subcategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Nombre del Subcategoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_subCategoria">Nombre de Subcategoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre de Subcategoria" class="form-control" id="nombre_subCategoria"
                        name="nombre_subCategoria" value="{{ old('nombre_subCategoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_subCategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Descripcion de Subcategoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="descripcion_subCategoria">Descripción de Subcategoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción de Subcategoria" class="form-control"
                        id="descripcion_subCategoria" name="descripcion_subCategoria"
                        value="{{ old('descripcion_subCategoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_subCategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            {{-- Boton para enviar el registro de sub categoria --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar SubCategoria">
                Enviar
            </button>


        </form>
    </div>
@endsection
