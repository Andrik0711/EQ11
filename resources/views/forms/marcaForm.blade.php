@extends('layouts.user_type.auth')

@section('content')
    <h1 class=" text-left font-semibold text-sm">Formulario de registro de Marca</h1>

    <div class=" rounded-3xl border-cyan-500 ">
        {{-- Formulario para registrar una categoria --}}
        <form action="" method="" novalidate>

            @csrf


            {{-- Codigo de la sub categoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_marca">Nombre de la Marca</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre de la marca" class="form-control" id="nombre_marca"
                        name="nombre_marca" value="{{ old('nombre_marca') }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            {{-- Descripcion de marca --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="descripcion_marca">Descripción de la Marca</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción de la Marca" class="form-control" id="descripcion_marca"
                        name="descripcion_marca" value="{{ old('descripcion_marca') }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_marca')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo oculto para la subida de la imagen --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="">Imagen</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Suba una imagen" class="form-control" id="" name=""
                        value="{{ old('') }}" />

                    {{-- Mensaje de error --}}
                    @error('')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            {{-- Boton para enviar el registro de sub categoria --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar Marca">
                Enviar
            </button>


        </form>
    </div>
@endsection
