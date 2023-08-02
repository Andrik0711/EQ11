@extends('layouts.user_type.auth')

@section('title', 'POS')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            {{-- Boton para mostrar de nuevo todos los productos --}}
            <div class="d-flex">
                <div class="container ">
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('punto-de-venta') }}"
                            class="btn bg-gradient-primary mt-4 mx-2 align-content-center flex-wrap" type="submit">
                            Mostrar todos los productos
                        </a>

                        <a href="#" class="btn bg-gradient-primary mt-4 mx-2" type="submit">
                            <img src="{{ asset('images/icons/icon-carrito.svg') }}" alt="icono carrito" width="30px">
                            100
                        </a>
                    </div>
                </div>
            </div>



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
                                                        class="img-fluid border-radius-lg" width="30%">
                                                </a>
                                            </div>
                                            <div class="card-body pt-4 d-flex justify-content-center">
                                                <span
                                                    class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
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
                <button class="carousel-control-prev" type="button" data-bs-target="#categoriaCarousel"
                    data-bs-slide="prev">
                    <span class="d-flex justify-content-start" aria-hidden="true">
                        <img src="{{ asset('images/icons/icon-arrowright.svg') }}" alt="arrow right" width="30%">
                    </span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categoriaCarousel"
                    data-bs-slide="next">
                    <span class="d-flex justify-content-end" aria-hidden="true">
                        <img src="{{ asset('images/icons/icon-arrowleft.svg') }}" alt="arrow right" width="30%">
                    </span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        {{-- Mostrar productos --}}
        <div class="container-fluid py-4">
            @if (isset($productosfiltrados))
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                    @foreach ($productosfiltrados as $producto)
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card">
                                    <a href="{{ route('producto-seleccionado', $producto->id) }}">
                                        <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                            class="card-img-top" alt="{{ $producto->nombre_producto }}">
                                    </a>
                                    {{-- <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                        class="card-img-top" alt="Producto"> --}}
                                    <div class="card-body">
                                        <span
                                            class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                            {{ $producto->categoria->nombre_categoria }}
                                        </span>
                                        <h5 class="card-title">{{ $producto->nombre_producto }}</h5>
                                        <p class="card-text">{{ $producto->descripcion_producto }}</p>
                                        <p class="card-text">Precio de venta: ${{ $producto->precio_de_venta }}</p>
                                        <p class="card-text">Unidades disponibles:
                                            {{ $producto->unidades_disponibles }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Aquí mostrar todos los productos sin filtrar -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                    @foreach ($todosLosProductos as $producto)
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card">
                                    <a href="{{ route('producto-seleccionado', $producto->id) }}">
                                        <img src="{{ asset('productos/' . '/' . $producto->imagen_producto) }}"
                                            class="card-img-top" alt="{{ $producto->nombre_producto }}">
                                    </a>
                                    <div class="card-body">
                                        <span
                                            class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                            {{ $producto->categoria->nombre_categoria }}
                                        </span>
                                        <h5 class="card-title">{{ $producto->nombre_producto }}</h5>
                                        <p class="card-text">{{ $producto->descripcion_producto }}</p>
                                        <p class="card-text">Precio de venta: ${{ $producto->precio_de_venta }}</p>
                                        <p class="card-text">Unidades disponibles:
                                            {{ $producto->unidades_disponibles }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
@endsection




@push('scripts')
    <!-- Antes del cierre del body de tu layout.blade.php -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endpush
