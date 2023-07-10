@extends('layouts.user_type.auth')

@section('content')
    <h1 class=" text-left font-semibold text-sm">Formulario de productos</h1>

    <div class=" rounded-3xl border-cyan-500 ">
        {{-- Formulario para registrar una categoria --}}
        <form action="" method="" novalidate>

            @csrf
            {{-- Seleccion de la categoria --}}
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

            {{-- Seleccion de la sub categoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="">Seleccione una Subcategoria</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Seleccione una sub categoria" class="form-control" id=""
                        name="" value="{{ old('') }}" />

                    {{-- Mensaje de error --}}
                    @error('')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Nombre del producto --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_producto">Nombre del producto</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre del producto" class="form-control" id="nombre_producto"
                        name="nombre_producto" value="{{ old('nombre_producto') }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_producto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Precio de compra --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="precio_de_compra">Precio de compra</label>
                    {{-- Input --}}
                    <input type="number" placeholder="Precio de compra" class="form-control" id="precio_de_compra"
                        name="precio_de_compra" value="{{ old('precio_de_compra') }}" />

                    {{-- Mensaje de error --}}
                    @error('precio_de_compra')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Precio de venta --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="precio_de_venta">Precio de venta</label>
                    {{-- Input --}}
                    <input type="number" placeholder="Precio de venta" class="form-control" id="precio_de_venta"
                        name="precio_de_venta" value="{{ old('precio_de_venta') }}" />

                    {{-- Mensaje de error --}}
                    @error('')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Unidades disponibles --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="unidades_disponibles">Unidades disponibles</label>
                    {{-- Input --}}
                    <input type="number" placeholder="Unidades disponibles" class="form-control" id="unidades_disponibles"
                        name="unidades_disponibles" value="{{ old('unidades_disponibles') }}" />

                    {{-- Mensaje de error --}}
                    @error('')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            {{-- Boton para enviar el registro de Producto --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar Producto">
                Enviar
            </button>


        </form>
    </div>
@endsection
