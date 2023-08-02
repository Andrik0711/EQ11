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
                                            {{-- {{ $totalMarcas->count() }} --}}
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
                                            {{-- {{ $totalMarcas->count() }} --}}
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
                                            {{-- {{ $totalMarcas->count() }} --}}
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
                                            {{-- {{ $totalMarcas->count() }} --}}
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
                                    <img src="{{ asset('images/icons/icon-ingresos.svg') }}" alt="usuarios"
                                        width="60px">
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
                                    <img src="{{ asset('images/icons/icon-egresos.svg') }}" alt="usuarios"
                                        width="60px">
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
                                    <img src="{{ asset('images/icons/icon-gastodiario.svg') }}" alt="usuarios"
                                        width="60px">
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
                                    <img src="{{ asset('images/icons/icon-gastomensual.svg') }}" alt="usuarios"
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
@push('dashboard')
    <script>
        window.onload = function() {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: false
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: "Mobile apps",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                            maxBarThickness: 6

                        },
                        {
                            label: "Websites",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#3A416F",
                            borderWidth: 3,
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endpush
