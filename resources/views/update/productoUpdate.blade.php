@extends('layouts.user_type.auth')

@section('content')
    <h1 class="text-left font-semibold text-sm">Formulario de productos</h1>

    <div class="rounded-3xl border-cyan-500">
        {{-- Formulario para editar un producto --}}
        <form action="{{ route('editar-producto-update', $producto->id) }}" method="POST" novalidate>

            @csrf
            @method('PUT')

            {{-- Seleccion de la categoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="id_categoria_producto">Seleccione una categoría</label>
                    {{-- Select --}}
                    <select class="form-control" id="id_categoria_producto" name="id_categoria_producto">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @if ($categoria->id == $producto->id_categoria_producto) selected @endif>
                                {{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>

                    {{-- Mensaje de error --}}
                    @error('id_categoria_producto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Seleccion de la sub categoria --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="id_subcategoria_producto">Seleccione una Sub categoría</label>
                    {{-- Select --}}
                    <select class="form-control" id="id_subcategoria_producto" name="id_subcategoria_producto">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}" @if ($subcategoria->id == $producto->id_subcategoria_producto) selected @endif>
                                {{ $subcategoria->nombre_subcategoria }}</option>
                        @endforeach
                    </select>

                    {{-- Mensaje de error --}}
                    @error('id_subcategoria_producto')
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
                        name="nombre_producto" value="{{ $producto->nombre_producto }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_producto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Descripción del producto --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="descripcion_producto">Descripción del producto</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción del producto" class="form-control"
                        id="descripcion_producto" name="descripcion_producto"
                        value="{{ $producto->descripcion_producto }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_producto')
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
                        name="precio_de_compra" value="{{ $producto->precio_de_compra }}" />

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
                        name="precio_de_venta" value="{{ $producto->precio_de_venta }}" />

                    {{-- Mensaje de error --}}
                    @error('precio_de_venta')
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
                        name="unidades_disponibles" value="{{ $producto->unidades_disponibles }}" />

                    {{-- Mensaje de error --}}
                    @error('unidades_disponibles')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
            <input type="hidden" id="producto_creado_por" name="producto_creado_por" value="{{ auth()->user()->name }}">

            {{-- Boton para enviar la actualización del Producto --}}
            <button class="btn bg-gradient-success" type="submit" value="Actualizar Producto">
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
