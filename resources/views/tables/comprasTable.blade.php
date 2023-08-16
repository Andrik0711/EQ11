@extends('layouts.user_type.auth')

@section('title', 'Compras')

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
                        <h6 class="mb-0">Tabla de compras</h6>
                        <div class="d-flex justify-content-end">
                            <!-- {{-- Imagen para imprimir --}}
                                            <a href="{{ route('importar-productos') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                                <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print" width="30px">
                                            </a> -->

                            {{-- Botón para exportar el PDF --}}
                            <a href="{{ route('reporte-compras.pdf') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                            </a>

                            <!-- {{-- Imagen para exportar XML --}}
                                            <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                                <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                                            </a> -->

                            {{-- Boton de agregar productos --}}
                            <a href="{{ route('compras') }}" class="btn bg-gradient-primary mt-4">Generar compra
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pt-2 pb-2">
                    <div class="table-responsive p-2">
                        <table id="compras-table" class="table align-items-center mb-0 text-center">
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
                                        Proveedor</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Estado</th>

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
                                        Eliminar</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($compras as $compra)
                                    <tr>
                                        <td>
                                            <!-- Checkbox for each row -->
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input checkbox-item" type="checkbox"
                                                    id="check-{{ $compra->id }}">
                                            </div>
                                        </td>
                                        <td class="text-center text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $compra->proveedor->nombre_proveedor }}</span>
                                        </td>
                                        <td>
                                            {{-- Si la venta es pendiente muestra success --}}
                                            @if ($compra->compra_status == 'pendiente')
                                                <span
                                                    class="badge badge-sm bg-gradient-info">{{ $compra->compra_status }}</span>
                                            @elseif ($compra->compra_status == 'iniciada')
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $compra->compra_status }}</span>
                                            @elseif ($compra->compra_status == 'terminada')
                                                <span
                                                    class="badge badge-sm bg-gradient-danger">{{ $compra->compra_status }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($compra->compra_subtotal, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($compra->compra_impuestos, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">$
                                                {{ number_format($compra->compra_total, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $compra->compra_productos_comprados }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $compra->fecha_compra }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="eliminar-venta-btn btn bg-gradient-danger mt-3"
                                                data-bs-toggle="modal" data-bs-target="#modal-default-{{ $compra->id }}">
                                                <img src="{{ asset('images/icons/icon-delete.svg') }}" alt="delete"
                                                    width="30px">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn bg-gradient-warning mt-3"
                                                data-bs-toggle="modal" data-bs-target="#modal-detalle-{{ $compra->id }}">
                                                <img src="{{ asset('images/icons/icon-detalle.svg') }}" alt="delete"
                                                    width="30px">
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">No se encontraron compras</td>
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
    @foreach ($compras as $compra)
        <div class="modal fade" id="modal-default-{{ $compra->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-{{ $compra->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default-{{ $compra->id }}">¿Estás seguro de eliminar la
                            compra <span class="modal-edit-name">{{ $compra->id }}</span>?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle the category deletion -->
                        <form action="{{ route('eliminar-compra', $compra->id) }}" method="POST">
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



        <div class="modal fade" id="modal-detalle-{{ $compra->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-detalle-{{ $compra->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-detalle-{{ $compra->id }}">¿Seguro qué quieres mirar
                            la compra <span class="modal-edit-name">{{ $compra->id }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('mostrar-ticket-compra', $compra->id) }}">
                            <button type="button" class="btn bg-gradient-info">SI</button>
                        </a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal para mostrar mensaje --}}
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- Condicionamos el tipo de mensaje --}}
                    @if (session('success'))
                        <h5 class="modal-title" id="successModalLabel">¡Bien!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    @elseif (session('warning'))
                        <h5 class="modal-title" id="successModalLabel">¡Cuidado!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    @elseif (session('error'))
                        <h5 class="modal-title" id="successModalLabel">¡Algo salio mal!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    @endif
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    @if (session('success'))
                        <img src="{{ asset('images/icons/icon-success.svg') }}" alt="icono de exito" class="mb-2"
                            width="70%">
                        {{ session('success') }}
                    @elseif (session('warning'))
                        <img src="{{ asset('images/icons/icon-warning.svg') }}" alt="icono de warning" class="mb-2"
                            width="70%">
                        {{ session('warning') }}
                    @elseif (session('error'))
                        <img src="{{ asset('images/icons/icon-error.svg') }}" alt="icono de error" class="mb-2"
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
            $('#compras-table').DataTable({
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
            @if (session('success'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @elseif (session('warning'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @elseif (session('error'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @endif
        });
    </script>
@endpush
