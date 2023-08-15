@extends('layouts.user_type.auth')

@section('title', 'Devolución de venta')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-2">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h6 class="mb-0">Detalle de devolución</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para imprimir --}}
                                    {{-- <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print"
                                            width="30px">
                                    </a> --}}

                                    {{-- Imagen para exportar pdf --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                                    </a>

                                    {{-- Imagen para exportar XML --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                                    </a>

                                    {{-- Boton de agregar productos --}}
                                    <a href="{{ route('mostrar-ventas') }}"
                                        class="d-flex btn bg-gradient-primary mt-4 align-content-center">
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="container mx-4">
                                <div class="row ">
                                    <div class="col">
                                        <h6 class="mb-1">Información del cliente</h6>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Nombre:</span>
                                            <span class="text-secondary text-xs font-weight-bold ">
                                                {{ $venta_realizada->cliente->nombre_cliente }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Dirección:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->cliente->direccion_cliente }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Teléfono:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->cliente->telefono_cliente }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Correo:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->cliente->email_cliente }}</span>
                                        </p>
                                    </div>

                                    <div class="col"> </div>

                                    <div class="col">
                                        <h6 class="mb-1">Información de la venta</h6>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Código:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->id }}</span>
                                        </p>

                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Estado:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->venta_status }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Productos:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->venta_unidades_vendidas }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive p-0">
                                <table id="productos-table" class="table align-items-center mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Producto </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Unidades</th>
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio unitario</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Subtotal</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                IVA</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total</th> --}}
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Devolver uno</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Devolver todos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($venta_realizada->productos as $producto)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('productos') . '/' . $producto->imagen_producto }}"
                                                                class="me-3 rounded-3 ms-4" width="100px"
                                                                alt="{{ $producto->nombre_producto }}">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $producto->nombre_producto }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $producto->pivot->cantidad_vendida }}
                                                    </p>
                                                </td>
                                                {{-- <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ number_format($producto->pivot->precio_unitario, 2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ number_format($producto->pivot->subtotal, 2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ number_format($producto->pivot->subtotal * 0.16, 2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $
                                                        {{ number_format($producto->pivot->subtotal + $producto->pivot->subtotal * 0.16, 2) }}
                                                    </p>
                                                </td> --}}
                                                <td>
                                                    <div class="d-flex justify-content-center align-content-center">
                                                        <form
                                                            action="{{ route('devolver-producto-venta', ['producto_id' => $producto->id, 'venta_id' => $venta_realizada->id]) }}"
                                                            method="POST" novalidate>

                                                            @csrf
                                                            {{-- Campo oculto para mandar 1 como cantidad vendidad del producto --}}
                                                            <input type="hidden" name="cantidad_vendida" value="1">
                                                            <button type="submit"
                                                                class="btn bg-gradient-info mt-3">Devolver
                                                                1</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-content-center">

                                                        <form
                                                            action="{{ route('devolver-producto-venta', ['producto_id' => $producto->id, 'venta_id' => $venta_realizada->id]) }}"
                                                            method="POST" novalidate>
                                                            @csrf
                                                            {{-- Campo oculto para mandar todos la cantidad vendidad del producto --}}
                                                            <input type="hidden" name="cantidad_vendida"
                                                                value="{{ $producto->pivot->cantidad_vendida }}">
                                                            <button type="submit"
                                                                class="btn bg-gradient-warning mt-3">Devolver
                                                                todos</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No se encontraron ventas</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                <p class="text-sm font-weight-bold mb-0">Costo final:</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    $ {{ number_format($venta_realizada->venta_total, 2) }}
                                                </p>
                                            </td>
                                            {{-- <td>
                                                <div class="d-flex justify-content-center align-content-center">
                                                    <form
                                                        action="{{ route('devolver-venta-completa', $venta_realizada->id) }}"
                                                        method="POST" novalidate
                                                        class="d-flex justify-center align-content-center">
                                                        @csrf
                                                        <button type="submit" class="btn bg-gradient-danger mt-3">Devolver
                                                            venta</button>
                                                    </form>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@push('modals')
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Bien!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    <img src="{{ asset('images/icons/icon-success.svg') }}" alt="icono de exito" class="mb-2"
                        width="70%">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">¡Cuidado!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    <img src="{{ asset('images/icons/icon-warning.svg') }}" alt="icono de warning" class="mb-2"
                        width="70%">
                    {{ session('warning') }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">¡Algo salió mal!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    <img src="{{ asset('images/icons/icon-error.svg') }}" alt="icono de error" class="mb-2"
                        width="70%">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    {{-- Modales --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @elseif (session('warning'))
                $('#warningModal').modal('show');
                setTimeout(function() {
                    $('#warningModal').modal('hide');
                }, 6000);
            @elseif (session('error'))
                $('#errorModal').modal('show');
                setTimeout(function() {
                    $('#errorModal').modal('hide');
                }, 6000);
            @endif
        });
    </script>
@endpush
