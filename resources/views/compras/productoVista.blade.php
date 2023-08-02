@extends('layouts.user_type.auth')

@section('title', 'Vista del producto')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card">
                {{-- Columnas --}}
                <div class="row row-cols-3">
                    {{-- Columna izquierda solo la imagen del producto --}}
                    <div class="col">
                        <div class="card">
                            <div class="card-header p-0 mx-3 my-3 position-relative z-index-1 rounded">
                                <a href="{{ route('filtrar-productos', $producto->id) }}"
                                    class="d-block d-flex justify-content-center">
                                    <img src="{{ asset('productos/' . $producto->imagen_producto) }}"
                                        class="img-fluid border-radius-lg" width="80%">
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Columna del medio con los datos del producto --}}
                    <div class="col">
                        <div class="card-body py-4 d-flex justify-content-start">
                            <div class="container">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <span
                                            class="text-gradient text-primary text-uppercase text-lg font-weight-bold my-2">
                                            {{ $producto->nombre_producto }}
                                        </span>
                                    </div>
                                    <div class="col">
                                        <p>{{ $producto->descripcion_producto }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-4">Precio de venta: ${{ $producto->precio_de_venta }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-4">Unidades disponibles: {{ $producto->unidades_disponibles }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Columna de la derecha con los botones, stock y dropdown --}}
                    <div class="col">
                        <div class="card-body py-4 d-flex justify-content-start">
                            <div class="container">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="mb-4">
                                            <input type="number" id="cantidad" name="cantidad" class="form-control"
                                                placeholder="Cantidad a comprar" min="1"
                                                value="{{ old('cantidad') }}" max="{{ $producto->unidades_disponibles }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="">
                                            <button type="button" class="btn btn-primary mt-3">Comprar ahora</button>
                                            <button type="button" class="btn btn-success mt-3">Agregar al
                                                carrito</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
