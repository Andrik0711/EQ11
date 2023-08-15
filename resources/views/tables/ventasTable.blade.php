@extends('layouts.user_type.auth')

@section('title', 'Ventas')

@push('styles')
    {{-- Agregamos del cdn de datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    {{-- Referenciamos los estilos de app.css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Tabla de ventas</h6>
                        <div class="d-flex justify-end">
                            {{-- Imagen para imprimir --}}
                            <a href="{{ route('importar-productos') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print" width="30px">
                            </a>

                            {{-- Imagen para exportar pdf --}}
                            <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                            </a>

                            {{-- Imagen para exportar XML --}}
                            <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                            </a>

                            {{-- Boton de agregar productos --}}
                            <a href="{{ route('punto-de-venta') }}" class="btn bg-gradient-primary mt-4">Punto de
                                Venta
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="productos-table" class="table align-items-center mb-0 text-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{--
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="check-all">
                                                </div> --}}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Cliente comprador</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Estado</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pago realizado</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Sub total</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Impuestos</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Costo total</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Productos vendidos</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha de venta</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Devolución</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Eliminar</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Detalle</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($ventas as $venta)
                                    <tr>
                                        <td>
                                            <!-- Checkbox for each row -->
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input checkbox-item" type="checkbox"
                                                    id="check-{{ $venta->id }}">
                                            </div>
                                        </td>
                                        <td class="text-center text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $venta->cliente->nombre_cliente }}</span>
                                        </td>
                                        <td>
                                            {{-- Si la venta es pendiente muestra success --}}
                                            @if ($venta->venta_status == 'terminada')
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $venta->venta_status }}</span>
                                            @elseif ($venta->venta_status == 'devuelta')
                                                <span
                                                    class="badge badge-sm bg-gradient-warning">{{ $venta->venta_status }}</span>
                                            @else
                                                <span
                                                    class="badge badge-sm bg-gradient-danger">{{ $venta->venta_status }}</span>
                                            @endif

                                        </td>
                                        <td class="text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($venta->venta_abono, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($venta->venta_subtotal, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($venta->venta_impuestos, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($venta->venta_total, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $venta->venta_unidades_vendidas }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $venta->fecha_venta }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="generar-devolucion-btn btn bg-gradient-info mt-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-devolucion-{{ $venta->id }}">
                                                <img src="{{ asset('images/icons/icon-devoluciones.svg') }}" alt="delete"
                                                    width="30px">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="eliminar-venta-btn btn bg-gradient-danger mt-3"
                                                data-bs-toggle="modal" data-bs-target="#modal-default-{{ $venta->id }}">
                                                <img src="{{ asset('images/icons/icon-delete.svg') }}" alt="delete"
                                                    width="30px">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn bg-gradient-warning mt-3"
                                                data-bs-toggle="modal" data-bs-target="#modal-detalle-{{ $venta->id }}">
                                                <img src="{{ asset('images/icons/icon-detalle.svg') }}" alt="delete"
                                                    width="30px">
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">No se encontraron ventas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('modals')
    @foreach ($ventas as $venta)
        {{-- Modal para realizar una eliminacion --}}
        <div class="modal fade" id="modal-default-{{ $venta->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-{{ $venta->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default-{{ $venta->id }}">¿Estás seguro de eliminar la
                            venta <span class="modal-edit-name">{{ $venta->id }}</span>?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle the category deletion -->
                        <form action="{{ route('eliminar-venta', $venta->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn bg-gradient-danger">Eliminar</button>
                        </form>
                        <button type="button" class="btn bg-gradient-info ml-auto"
                            data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- modal para mostrar detalle de la venta --}}
        <div class="modal fade" id="modal-detalle-{{ $venta->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-detalle-{{ $venta->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-detalle-{{ $venta->id }}">¿Seguro qué quieres mirar
                            la venta <span class="modal-edit-name">{{ $venta->id }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('mostrar-ticket', $venta->id) }}">
                            <button type="button" class="btn bg-gradient-info">SI</button>
                        </a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para generar una devolucion --}}
        <div class="modal fade" id="modal-devolucion-{{ $venta->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-devolucion-{{ $venta->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">Devolución</h3>
                                <p class="mb-0">¿Quieres generar una devoluión?</p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('mostrar-devolucion', $venta->id) }}">
                                    <button type="button" class="btn bg-gradient-info">SI</button>
                                </a>
                                <button type="button" class="btn bg-gradient-danger"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal de éxito --}}
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Bien!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center">
                    @if (session('success'))
                        <img src="{{ asset('images/icons/icon-success.svg') }}" alt="icono de exito" class="mb-2"
                            width="70%">
                        {{ session('success') }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Ups!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center">
                    @if (session('error'))
                        <img src="{{ asset('images/icons/icon-error.svg') }}" alt="icono de exito" class="mb-2"
                            width="70%">
                        {{ session('error') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endpush


@push('scripts')
    {{-- Agregamos del cdn de datatable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    {{-- Modales --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    {{-- Este script permite modificar los textos de el datatable --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTable with drawCallback and language options
            $('#productos-table').DataTable({
                "drawCallback": function(settings) {
                    // Find the "Previous" and "Next" button elements and change their content
                    $('.dataTables_wrapper .pagination .page-item.previous .page-link').html('&lt;');
                    $('.dataTables_wrapper .pagination .page-item.next .page-link').html('&gt;');

                    // Find the "Search" label and replace it with "Buscar" text but keep the input
                    $('.dataTables_wrapper .dataTables_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).replaceWith('Buscar');

                    // Find the "Show [entries] entries" label and modify its text
                    $('.dataTables_wrapper .dataTables_length label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).replaceWith(function() {
                        return this.textContent.replace('Show', 'Mostrar').replace('entries',
                            'registros');
                    });

                    // Find "Showing [start] to [end] of [entries] entries" text and modify its text
                    $('.dataTables_wrapper .dataTables_info').contents().filter(function() {
                        return this.nodeType === 3;
                    }).replaceWith(function() {
                        return this.textContent.replace('Showing', 'Mostrando').replace('to',
                                'de').replace('of',
                                'de')
                            .replace('entries', 'registros');
                    });
                },
                "language": {
                    "infoFiltered": "" // Remove the "(filtered from x total entries)" text
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Verificar si hay un mensaje en sesión y mostrar el modal
            @if (session('success'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
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
