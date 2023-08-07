@extends('layouts.user_type.auth')

@section('title', 'Registrar cotización')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Generar una cotizacion</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-cotizaciones') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Mensaje --}}
                @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('mensaje') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('warning') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body px-4 pt-2 pb-2">
                    {{-- Contiene todo los productos y sus filtros --}}
                    <div class="container-fluid">
                        {{-- Boton para mostrar de nuevo todos los productos --}}
                        <div class="d-flex">
                            <div class="container ">
                                <div class="col d-flex justify-content-start">
                                    <a href="{{ route('registrar-cotizacion-form') }}"
                                        class="btn bg-gradient-primary mt-4 mx-2 align-content-center flex-wrap"
                                        type="submit">
                                        Mostrar todos los productos
                                    </a>
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
                                                            <a href="{{ route('filtrar-productos-cotizacion', $categoria->id) }}"
                                                                class="d-block d-flex justify-content-center">
                                                                <img src="{{ asset('categorias/' . $categoria->imagen_categoria) }}"
                                                                    class="img-fluid border-radius-lg" width="20%">
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

                        <div class="container-fluid mt-5">
                            @if (isset($productosfiltrados))
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                    @foreach ($productosfiltrados as $producto)
                                        <div class="col mb-4">
                                            <div class="card">
                                                <div class="card">
                                                    <form action="{{ route('agregar-cotizacion') }}" method="POST"
                                                        novalidate>
                                                        @csrf

                                                        <input type="hidden" name="producto_id"
                                                            value="{{ $producto->id }}">

                                                        <a class="d-flex justify-content-center">
                                                            <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                                                class="rounded d-flex justify-content-center mt-2"
                                                                width="20%" alt="{{ $producto->nombre_producto }}">
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

                                                            <div class="d-flex justify-content-start pb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <p class="card-text">
                                                                        Cantidad:
                                                                    </p>
                                                                </div>
                                                                <div class="input-group input-group-sm ms-2 me-6">
                                                                    <input class="form-control" type="number"
                                                                        name="cantidad_venta" id="cantidad_venta"
                                                                        min="1"
                                                                        max="{{ $producto->unidades_disponibles }}"
                                                                        value="cantidad_venta" placeholder="1">
                                                                </div>
                                                            </div>
                                                            {{-- Boton para enviar --}}
                                                            <button class="btn bg-gradient-primary" name="agregar"
                                                                value="add">Añadir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <!-- Aquí mostrar todos los productos sin filtrar -->
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                    @foreach ($todosLosProductos as $producto)
                                        <div class="col mb-4">
                                            <div class="card">
                                                <div class="card">
                                                    <form action="{{ route('agregar-cotizacion') }}" method="POST"
                                                        novalidate>
                                                        @csrf

                                                        <input type="hidden" name="producto_id"
                                                            value="{{ $producto->id }}">

                                                        <a class="d-flex justify-content-center">
                                                            <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                                                class="rounded d-flex justify-content-center mt-2"
                                                                width="20%" alt="{{ $producto->nombre_producto }}">
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

                                                            <div class="d-flex justify-content-start pb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <p class="card-text">
                                                                        Cantidad:
                                                                    </p>
                                                                </div>
                                                                <div class="input-group input-group-sm ms-2 me-6">
                                                                    <input class="form-control" type="number"
                                                                        name="cantidad_venta" id="cantidad_venta"
                                                                        min="1"
                                                                        max="{{ $producto->unidades_disponibles }}"
                                                                        value="cantidad_venta" placeholder="1">
                                                                </div>
                                                            </div>
                                                            {{-- Boton para enviar --}}
                                                            <button class="btn bg-gradient-primary" name="agregar"
                                                                value="add">Añadir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Contiene la tabla donde se agregan los productos para cotizar --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header pb-2">
                                        <div class="d-flex justify-content-between align-items-center mx-4">
                                            <h6 class="mb-0">Productos agregados</h6>
                                        </div>
                                    </div>

                                    @php
                                        $tabla = session()->get('tabla', []);
                                        $subtotal = 0;
                                        $impuestos = 0;
                                        $total = 0;
                                    @endphp

                                    <div class="card-body px-4 pt-2 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0 text-center ">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            scope="col text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Producto</th>
                                                        <th
                                                            scope="col text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Precio</th>
                                                        <th
                                                            scope="col text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Cantidad</th>
                                                        <th
                                                            scope="col text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Subtotal</th>
                                                        <th
                                                            scope="col text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Impuestos</th>
                                                        <th
                                                            scope="col text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- ? Inicializamos estos campos --}}
                                                    @php
                                                        $totalImpuestos = 0;
                                                        $cantidadProductos = 0;
                                                        $subtotal = 0;
                                                    @endphp
                                                    @foreach ($tabla as $producto_id => $producto)
                                                        @php
                                                            // $cantidadDisponible = $producto['unidades_disponibles'];
                                                            $cantidadProductos += $producto['cantidad'];
                                                            $subtotal += $producto['precio'] * $producto['cantidad'];
                                                            $totalImpuestos += $producto['precio'] * $producto['cantidad'] * 0.16;
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div>
                                                                        <img src="{{ asset('productos') . '/' . $producto['imagen'] }}"
                                                                            alt="{{ $producto['nombre'] }}"
                                                                            width="80px" class="border-radius-lg">
                                                                    </div>
                                                                    <div
                                                                        class="mx-3 d-flex justify-content-center align-items-center">
                                                                        <h6 class="mb-0 text-sm">
                                                                            {{ $producto['nombre'] }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>${{ number_format($producto['precio'], 2) }}</td>
                                                            <td>{{ $producto['cantidad'] }}</td>
                                                            <td>${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}
                                                            </td>
                                                            <td>${{ number_format($producto['precio'] * $producto['cantidad'] * 0.16, 2) }}
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <form action="{{ route('eliminar-cotizacion') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="hidden" name="producto_id"
                                                                            value="{{ $producto_id }}">
                                                                        <button class="btn bg-gradient-danger mt-3"
                                                                            name="eliminar"
                                                                            value="delete">Eliminar</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td class="text-right font-weight-bold">Impuestos total:</td>
                                                        <td>${{ number_format($totalImpuestos, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td class="text-right font-weight-bold">Subtotal:</td>
                                                        <td>${{ number_format($subtotal, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td class="text-right font-weight-bold">Cotización total:</td>
                                                        <td>${{ number_format($subtotal + $totalImpuestos, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <form action="{{ route('cotizacion-store') }}" method="POST" novalidate>
                                                @csrf

                                                <div class="row">
                                                    <div class="col">
                                                        {{-- Input para la fecha --}}
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <input class="form-control" type="date" name="fecha"
                                                                id="fecha" value="{{ old('fecha') }}"
                                                                placeholder="Fecha">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        {{-- Select para elegir al cliente que se va a cotizar --}}
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <select class="form-control" name="cliente_id"
                                                                id="cliente_id">
                                                                <option value="" selected disabled>Selecciona un
                                                                    cliente
                                                                </option>
                                                                @foreach ($clientes as $cliente)
                                                                    <option value="{{ $cliente->id }}">
                                                                        {{ $cliente->nombre_cliente }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        {{-- Input para el codigo de referencia --}}
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <input class="form-control" type="text"
                                                                name="codigo_referencia" id="codigo_referencia"
                                                                value="{{ old('codigo_referencia') }}"
                                                                placeholder="Codigo de referencia">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        {{-- Descripcion de la cotizacion --}}
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <input class="form-control" name="descripcion_cotizacion"
                                                                id="descripcion_cotizacion"
                                                                placeholder="Descripcion de la cotizacion"></input>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                                <input type="hidden" name="totalImpuestos"
                                                    value="{{ $totalImpuestos }}">
                                                <input type="hidden" name="total"
                                                    value="{{ $subtotal + $totalImpuestos }}">

                                                {{-- Campo oculta para el status iniciada, pendiente, inhabilitada --}}
                                                <input type="hidden" name="status_cotizacion" value="iniciada"
                                                    id="status_cotizacion">


                                                <div class="d-flex justify-content-end">
                                                    <button class="btn bg-gradient-primary mt-4 mx-2" name="guardar"
                                                        value="save">Guardar cotización</button>
                                                </div>
                                            </form>
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
