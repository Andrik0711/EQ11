@extends('layouts.user_type.auth')

@section('title', 'Vista del producto')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

        {{-- Alerta de éxito --}}
        @if (session('mensaje'))
            <div class="alert alert-info" role="alert">
                <strong>¡Información!</strong> {{ session('mensaje') }}
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="d-flex">
                <div class="container ">
                    <div class="col d-flex justify-content-end">

                        {{-- Boton para regresar a mostrar todos los productos --}}
                        <a href="{{ route('punto-de-venta') }}"
                            class="btn bg-gradient-primary mt-4 mx-2 align-content-center flex-wrap" type="submit">
                            Regresar
                        </a>

                        {{-- Muesta todos los productos comprados --}}
                        <a href="#" class="btn bg-gradient-primary mt-4 mx-2" type="submit">
                            <img src="{{ asset('images/icons/icon-carrito.svg') }}" alt="icono carrito" width="30px">
                            100
                        </a>
                    </div>
                </div>
            </div>

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
                                        <p class="mb-4">Unidades disponibles: {{ $producto->unidades_disponibles }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Columna de la derecha para agregar la cantida, comprar o agregar --}}
                    <div class="col">
                        <div class="card-body py-4 d-flex justify-content-start">
                            <div class="container">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        {{-- {{ route('accion-producto', ['productoId' => $producto->id]) }} --}}
                                        <form action="{{ route('accion-producto', $producto->id) }}" method="POST"
                                            novalidate>
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <input type="number" id="cantidad_producto" name="cantidad_producto"
                                                    class="form-control" placeholder="Cantidad a comprar" min="1"
                                                    value="{{ old('cantidad_producto') }}"
                                                    max="{{ $producto->unidades_disponibles }}">

                                                {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
                                                <input type="hidden" id="carrito_producto_id" name="carrito_producto_id"
                                                    value="{{ $producto->id }}">

                                                {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
                                                <input type="hidden" id="producto_creado_por" name="producto_creado_por"
                                                    value="{{ auth()->user()->id }}">


                                            </div>
                                            <button type="submit" name="accion" value="comprar"
                                                class="btn btn-success mt-3">Comprar ahora</button>
                                            <button type="submit" name="accion" value="agregar-carrito"
                                                class="btn btn-info mt-3">Agregar al carrito</button>
                                        </form>
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
