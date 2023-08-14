@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row row-cols-3">
            {{-- Usuarios totales --}}
            {{-- Anterior columna: col-xl-3 col-sm-6 mb-xl-0 mb-4 --}}
            <div class="col ">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-4">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Usuarios</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalUsuarios->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-cliente.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Proveedores totales --}}
            <div class="col ">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Proveedores</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalProveedores->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-proveedor.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Categorias totales --}}
            <div class="col ">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Categorias</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalCategorias->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-category.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Subcategorias totales --}}
            <div class="col ">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Subcategorias</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalSubcategorias->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-subcategory.svg') }}" alt="usuarios"
                                        width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Clientes totales --}}
            <div class="col ">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Clientes</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalClientes->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-cliente.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Productos totales --}}
            <div class="col">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Productos</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalProductos->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-producto.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Marcas totales --}}
            <div class="col">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Marcas</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalMarcas->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-marca.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Ventas totales --}}
            <div class="col">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Ventas</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalVentas->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-ventas.svg') }}" alt="usuarios"
                                        width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Compras totales --}}
            <div class="col">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Compras</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalCompras->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-shop.svg') }}" alt="usuarios" width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Cotizaciones totales --}}
            <div class="col">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Cotizaciones</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalCotizaciones->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-cotizaciones.svg') }}" alt="usuarios"
                                        width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Devoliciones totales --}}
            <div class="col">
                <div class="card my-4">
                    <div class="card-body p-3">
                        <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Devoluciones</p>
                                        <span class="text-success text-lg font-weight-bolder">
                                            {{ $totalDevoluciones->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('images/icons/icon-devoluciones.svg') }}" alt="usuarios"
                                        width="60px">
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('cosas')
    {{-- Ingresos totales --}}
    <div class="col">
        <div class="card my-4">
            <div class="card-body p-3">
                <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Ingresos</p>
                                <span class="text-success text-lg font-weight-bolder">
                                    {{-- {{ $totalMarcas->count() }} --}}
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('images/icons/icon-ingresos.svg') }}" alt="usuarios" width="60px">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>

    {{-- Egresos totales --}}
    <div class="col">
        <div class="card my-4">
            <div class="card-body p-3">
                <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Egresos</p>
                                <span class="text-success text-lg font-weight-bolder">
                                    {{-- {{ $totalMarcas->count() }} --}}
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('images/icons/icon-egresos.svg') }}" alt="usuarios" width="60px">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>

    {{-- Gastos diarios totales --}}
    <div class="col">
        <div class="card my-4">
            <div class="card-body p-3">
                <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Gastos diarios</p>
                                <span class="text-success text-lg font-weight-bolder">
                                    {{-- {{ $totalMarcas->count() }} --}}
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('images/icons/icon-gastodiario.svg') }}" alt="usuarios" width="60px">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>

    {{-- Gastos mensuales totales --}}
    <div class="col">
        <div class="card my-4">
            <div class="card-body p-3">
                <button type="button" class="btn bg-gradient-primary w-100 mb-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Gastos mensuales</p>
                                <span class="text-success text-lg font-weight-bolder">
                                    {{-- {{ $totalMarcas->count() }} --}}
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('images/icons/icon-gastomensual.svg') }}" alt="usuarios" width="60px">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
@endsection
