@extends('layouts.user_type.auth')

@section('title', 'POS')

@push('styles')
    <style>
        .carousel-control-prev,
        .carousel-control-next {
            width: auto;
            /* Ajusta el ancho automáticamente según el contenido */
            padding: 0;
            /* Elimina el espacio de relleno alrededor del botón */
            background: none;
            /* Elimina el fondo del botón */
            border: none;
            /* Elimina el borde del botón */
        }

        .carousel-control-prev img,
        .carousel-control-next img {
            width: 20px;
            /* Ajusta el ancho de la imagen */
            height: auto;
            /* Mantiene la proporción de la imagen */
        }
    </style>

    <!-- Resto de tu HTML -->
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        {{-- Columnas de 3 --}}
        <div class="containter-fluid">
            <div class="row">
                <div class="col col-md-7">
                    <div class="container-fluid">
                        {{-- Boton para mostrar de nuevo todos los productos --}}
                        <div class="d-flex">
                            <div class="container ">
                                <div class="col d-flex justify-content-start">
                                    <a href="{{ route('punto-de-venta') }}"
                                        class="btn bg-gradient-primary mt-4 mx-2 align-content-center flex-wrap"
                                        type="submit">
                                        Mostrar todos los productos
                                    </a>
                                    {{-- <a href="#" class="btn bg-gradient-primary mt-4 mx-2" type="submit">
                                        <img src="{{ asset('images/icons/icon-carrito.svg') }}" alt="icono carrito" width="30px">
                                        100
                                    </a> --}}
                                </div>
                            </div>
                        </div>

                        {{-- Mostrar categorias --}}
                        <div id="categoriaCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($categorias->chunk(3) as $chunk)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="row row-cols-3">
                                            @foreach ($chunk as $categoria)
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                                            <a href="{{ route('filtrar-productos', $categoria->id) }}"
                                                                class="d-block d-flex justify-content-center">
                                                                <img src="{{ asset('categorias/' . $categoria->imagen_categoria) }}"
                                                                    class="img-fluid border-radius-lg" width="60%">
                                                            </a>
                                                        </div>
                                                        <div class="card-body pt-4 d-flex justify-content-center">
                                                            <span
                                                                class="text-gradient text-primary text-uppercase font-weight-bold my-2">
                                                                {{ $categoria->nombre_categoria }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- ? Botones de flechas izquierda y derecha --}}
                            <button class="carousel-control-prev" type="button" data-bs-target="#categoriaCarousel"
                                data-bs-slide="prev">
                                <span class="d-flex justify-content-start" aria-hidden="true">
                                    <img src="{{ asset('images/icons/icon-arrowright.svg') }}" alt="arrow right"
                                        width="30%">
                                </span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#categoriaCarousel"
                                data-bs-slide="next">
                                <span class="d-flex justify-content-end" aria-hidden="true">
                                    <img src="{{ asset('images/icons/icon-arrowleft.svg') }}" alt="arrow right"
                                        width="30%">
                                </span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    {{-- Mostrar productos ya con filtros --}}
                    <div class="container-fluid mt-5">
                        @if (isset($productosfiltrados))
                            <div id="productoCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($productosfiltrados->chunk(3) as $chunk)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                                @foreach ($chunk as $producto)
                                                    <div class="col mb-4">
                                                        <div class="card">
                                                            <form action="{{ route('agregar-al-carrito') }}" method="POST"
                                                                novalidate>
                                                                @csrf

                                                                <input type="hidden" name="producto_id"
                                                                    value="{{ $producto->id }}">

                                                                <a name="imagen_producto">
                                                                    <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                                                        class="card-img-top"
                                                                        alt="{{ $producto->nombre_producto }}">
                                                                </a>
                                                                <div class="card-body">
                                                                    <span
                                                                        class="text-gradient text-primary text-uppercase font-weight-bold my-2">
                                                                        {{ $producto->categoria->nombre_categoria }}
                                                                    </span>
                                                                    <br>
                                                                    <span
                                                                        class="text-gradient text-info text-uppercase font-weight-bold my-2">
                                                                        {{ $producto->marca->nombre_marca }}
                                                                    </span>
                                                                    <h5 class="card-title">
                                                                        {{ $producto->nombre_producto }}</h5>
                                                                    <p class="card-text">
                                                                        {{ $producto->descripcion_producto }}</p>
                                                                    <p class="card-text">Precio de
                                                                        venta:
                                                                        ${{ $producto->precio_de_venta }}
                                                                    </p>
                                                                    <p class="card-text">Unidades
                                                                        disponibles:
                                                                        {{ $producto->unidades_disponibles }}
                                                                    </p>

                                                                    {{-- Boton para enviar --}}
                                                                    <button class="btn bg-gradient-primary" name="agregar"
                                                                        value="add">Añadir</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- Botones de flechas izquierda y derecha --}}
                                <button class="carousel-control-prev" type="button" data-bs-target="#productoCarousel"
                                    data-bs-slide="prev">
                                    <span class="d-flex justify-content-start" aria-hidden="true">
                                        <img src="{{ asset('images/icons/icon-arrowright.svg') }}" alt="arrow right"
                                            width="30%">
                                    </span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productoCarousel"
                                    data-bs-slide="next">
                                    <span class="d-flex justify-content-end" aria-hidden="true">
                                        <img src="{{ asset('images/icons/icon-arrowleft.svg') }}" alt="arrow right"
                                            width="30%">
                                    </span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div id="productoCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($todosLosProductos->chunk(3) as $chunk)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                                @foreach ($chunk as $producto)
                                                    <div class="col mb-4">
                                                        <div class="card">
                                                            <form action="{{ route('agregar-al-carrito') }}"
                                                                method="POST" novalidate>
                                                                @csrf

                                                                <input type="hidden" name="producto_id"
                                                                    value="{{ $producto->id }}">

                                                                <a name="imagen_producto">
                                                                    <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                                                        class="card-img-top"
                                                                        alt="{{ $producto->nombre_producto }}">
                                                                </a>
                                                                <div class="card-body">
                                                                    <span
                                                                        class="text-gradient text-primary text-uppercase font-weight-bold my-2">
                                                                        {{ $producto->categoria->nombre_categoria }}
                                                                    </span>
                                                                    <br>
                                                                    <span
                                                                        class="text-gradient text-info text-uppercase font-weight-bold my-2">
                                                                        {{ $producto->marca->nombre_marca }}
                                                                    </span>
                                                                    <h5 class="card-title">
                                                                        {{ $producto->nombre_producto }}</h5>
                                                                    <p class="card-text">
                                                                        {{ $producto->descripcion_producto }}</p>
                                                                    <p class="card-text">Precio de
                                                                        venta:
                                                                        ${{ $producto->precio_de_venta }}
                                                                    </p>
                                                                    <p class="card-text">Unidades
                                                                        disponibles:
                                                                        {{ $producto->unidades_disponibles }}
                                                                    </p>

                                                                    {{-- Boton para enviar --}}
                                                                    <button class="btn bg-gradient-primary" name="agregar"
                                                                        value="add">Añadir</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- Botones de flechas izquierda y derecha --}}
                                <button class="carousel-control-prev" type="button" data-bs-target="#productoCarousel"
                                    data-bs-slide="prev">
                                    <span class="d-flex justify-content-start" aria-hidden="true">
                                        <img src="{{ asset('images/icons/icon-arrowright.svg') }}" alt="arrow right"
                                            width="20%">
                                    </span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productoCarousel"
                                    data-bs-slide="next">
                                    <span class="d-flex justify-content-end" aria-hidden="true">
                                        <img src="{{ asset('images/icons/icon-arrowleft.svg') }}" alt="arrow right"
                                            width="20%">
                                    </span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Mostrar carrito --}}
                <div class="col col-md-5">
                    <div class="container-fluid my-4">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Carrito de compras</h4>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Productos agregados</h5>

                                {{-- Mostrar productos agregados al carrito --}}
                                <div class="row">
                                    <div class="col">
                                        @php
                                            $carrito = session()->get('carrito', []);
                                            $subtotal = 0;
                                            $impuestos = 0;
                                            $total = 0;
                                            $iva = 0.16;
                                            $costo_total = 0;
                                            $subtotal_total = 0;
                                            $cantidad_productos_diferentes = 0;
                                            $productosContados = [];
                                        @endphp

                                        @foreach ($carrito as $producto_id => $producto)
                                            {{-- Contamos los productos diferentes --}}
                                            @php
                                                if (!isset($productosContados[$producto_id])) {
                                                    $productosContados[$producto_id] = 1;
                                                    $cantidad_productos_diferentes++;
                                                }
                                            @endphp
                                            <div class="container-fluid mb-4">
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <img src="{{ asset('productos/' . '/' . $producto['imagen']) }}"
                                                        class="img-fluid border-radius-sm" width="30%"
                                                        alt="Producto imagen">

                                                    <div class="mx-2">



                                                        <h5 class="text-start text-sm"> {{ $producto['nombre'] }}</h5>
                                                        @php
                                                            $subtotal = $producto['precio'] * $producto['cantidad'];
                                                        @endphp
                                                        <p class="text-sm text-start">Costo: ${{ $subtotal }}
                                                        <p class="text-sm text-start">Cantidad:
                                                            {{ $producto['cantidad'] }}
                                                    </div>
                                                </div>

                                                {{-- Form delete --}}
                                                <div class="d-flex justify-content-start align-items-center mt-4">
                                                    {{-- Boton para eliminar el producto del carrito --}}
                                                    <form action="{{ route('eliminar-del-carrito') }}" method="POST"
                                                        novalidate>
                                                        @csrf

                                                        {{-- Campo oculto para pasar el id del producto --}}
                                                        <input type="hidden" name="producto_id"
                                                            value="{{ $producto_id }}">

                                                        {{-- Utilizar @method('DELETE') para enviar una solicitud DELETE --}}
                                                        @method('DELETE')

                                                        <button class="btn btn-sm bg-gradient-danger text-sm"
                                                            type="submit"
                                                            value="Eliminar producto del carrito">Eliminar</button>
                                                    </form>

                                                    {{-- Botones de add o less --}}
                                                    <div class="mx-1 d-flex justify-content-evenly">
                                                        {{-- Flecha izquierda --}}
                                                        <div class="mx-1">
                                                            <form action="{{ route('agregar-al-carrito') }}"
                                                                method="POST" novalidate>
                                                                @csrf

                                                                <input type="hidden" name="producto_id"
                                                                    value="{{ $producto_id }}">

                                                                <input type="hidden" name="agregar" value="less">

                                                                <button class="btn btn-sm btn-flecha-derecha"
                                                                    name="agregar" type="submit"
                                                                    value="less">-</button>
                                                            </form>
                                                        </div>

                                                        <div class="mx-1">
                                                            <button
                                                                class="cantidad-producto btn btn-sm btn-outline-primary"
                                                                data-cantidad="{{ $producto['cantidad'] }}">
                                                                {{ $producto['cantidad'] }}
                                                            </button>
                                                        </div>

                                                        {{-- Flecha derecha --}}
                                                        <div class="mx-1">
                                                            <form action="{{ route('agregar-al-carrito') }}"
                                                                method="POST" novalidate>
                                                                @csrf

                                                                <input type="hidden" name="producto_id"
                                                                    value="{{ $producto_id }}">

                                                                <input type="hidden" name="agregar" value="add">

                                                                <button class="btn btn-sm btn-flecha-derecha"
                                                                    name="agregar" type="submit"
                                                                    value="add">+</button>
                                                            </form>
                                                        </div>
                                                    </div>


                                                </div>

                                                {{-- Agregamos el impuesto --}}
                                                @php
                                                    $subtotal = $producto['precio'] * $producto['cantidad'];
                                                    $subtotal_total += $subtotal;
                                                    $impuestos = $subtotal * $iva;
                                                    $total = $subtotal + $impuestos;
                                                @endphp


                                                {{-- Mosrtamos el costo total Producto --}}
                                                <div class="d-flex justify-content-start align-items-center mt-2">
                                                    {{-- Iva --}}
                                                    <div class="mx-1">
                                                        <h5 class="text-sm text-start">
                                                            IVA: $ {{ number_format($impuestos, 2) }}</h5>
                                                    </div>
                                                    {{-- Sub total producto por cada producto y cantidad  --}}
                                                    <div class="mx-1">
                                                        <h5 class="text-sm text-start">
                                                            Subtotal: ${{ number_format($subtotal, 2) }}</h5>
                                                    </div>

                                                    <div class="mx-1">
                                                        <h5 class="text-sm text-start">
                                                            Total: ${{ number_format($total, 2) }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Alerta de éxito --}}
                                        @if (session('mensaje'))
                                            <div class="alert alert-success" role="alert">
                                                <strong>Success!</strong> {{ session('mensaje') }}
                                            </div>
                                        @elseif (session('Listo'))
                                            <div class="alert alert-success" role="alert">
                                                <strong>Listo!</strong> {{ session('Listo') }}
                                            </div>
                                        @elseif (session('warning'))
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Cuidado!</strong> {{ session('warning') }}
                                            </div>
                                        @endif




                                        {{-- Validamos si no hay carrito no muestre nada --}}
                                        @if (count($carrito) == 0)
                                            <div class="alert alert-warning" role="alert">
                                                No hay productos agregados al carrito.
                                            </div>
                                        @elseif (count($carrito) > 0)
                                            {{-- Boton para guardar la venta --}}
                                            <div class="my-4">
                                                <form action="{{ route('venta-store') }}" method="POST" novalidate>
                                                    @csrf
                                                    <div class="container-fluid mb-4">
                                                        <h5>Resumen del carrito:</h5>
                                                        <p>Subtotal final: ${{ number_format($subtotal_total, 2) }}</p>
                                                        <p>Impuestos final:
                                                            ${{ number_format($subtotal_total * $iva, 2) }}
                                                        </p>
                                                        <p>Costo total:
                                                            ${{ number_format($subtotal_total + $subtotal_total * $iva, 2) }}
                                                        </p>
                                                    </div>

                                                    {{-- Le pasamos el costo total de la venta --}}
                                                    <input type="hidden" name="total"
                                                        value="{{ $subtotal_total + $subtotal_total * $iva }}">

                                                    {{-- Le pasamos el subtotal de la venta --}}
                                                    <input type="hidden" name="subtotal" value="{{ $subtotal_total }}">

                                                    {{-- Le pasamos el impuesto de la venta --}}
                                                    <input type="hidden" name="impuestos"
                                                        value="{{ $subtotal_total * $iva }}">

                                                    {{-- Le pasamos el numero de productos vendidos --}}
                                                    <input type="hidden" name="unidades_vendidas"
                                                        value="{{ $cantidad_productos_diferentes }}">

                                                    {{-- Abono --}}
                                                    <div class="d-flex justify-content-start align-items-center mt-2">
                                                        {{-- Abono realizado --}}
                                                        <div class="mx-1">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-sm text-start">Pago:
                                                                        $</span>
                                                                    <input type="number" name="pago" id="pago"
                                                                        class="form-control text-sm text-start"
                                                                        placeholder="MX" value="{{ old('pago') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Selec para elegir el cliente --}}
                                                        <div class="form-group">
                                                            {{-- Select --}}
                                                            <select class="form-control" id="cliente_venta"
                                                                name="cliente_venta">
                                                                <option value="{{ old('cliente_venta') }}">Clientes
                                                                </option>
                                                                @foreach ($clientes as $cliente)
                                                                    <option value="{{ $cliente->id }}">
                                                                        {{ $cliente->nombre_cliente }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    {{-- Boton para enviar --}}
                                                    <button class="btn bg-gradient-success text-sm"
                                                        type="submit">Registrar venta</button>
                                                </form>
                                            </div>
                                        @endif
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


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $(".product-card").click(function() {
                $(this).closest("form").submit();
            });
        });
    </script>
@endpush
