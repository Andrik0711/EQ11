@extends('layouts.user_type.auth')

@section('title', 'Productos')

@push('styles')
    {{-- Agregamos del cdn de datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    {{-- Referenciamos los estilos de app.css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-2">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h6 class="mb-0">Tabla de productos</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para imprimir --}}
                                    <a href="{{ route('importar-productos') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print"
                                            width="30px">
                                    </a>

                                    {{-- Imagen para exportar pdf --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                                    </a>

                                    {{-- Boton de importar XML --}}
                                    <label for="xml-file-input" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="import" width="30px">
                                    </label>
                                    <form id="import-form" action="#" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="xml_file" accept=".xml" id="xml-file-input"
                                            style="display: none;">
                                    </form>

                                    {{-- Boton de agregar productos --}}
                                    <a href="{{ route('registrar-producto-form') }}"
                                        class="btn bg-gradient-primary mt-4"><img
                                            src="{{ asset('images/icons/icon-add.svg') }}" alt="add"
                                            width="30px">Agregar
                                        producto</a>
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
                                                Creada por</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Imagen</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Categoría padre</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Subcategoría</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Marca</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio de compra</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio de venta</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Unidades disponibles</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Editar</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Eliminar</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($productos as $producto)
                                            <tr>
                                                <td>
                                                    <!-- Checkbox for each row -->
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input checkbox-item" type="checkbox"
                                                            id="check-{{ $producto->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        {{-- <div>
                                                            <img src="{{ asset('usuarios') . '/' . Auth()->user()->imagen_usuario }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div> --}}
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $producto->producto_creado_por }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ asset('productos') . '/' . $producto->imagen_producto }}"
                                                        alt="{{ $producto->nombre_producto }}" width="60px"
                                                        class="border-radius-lg">
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $producto->categoria->nombre_categoria }}</p>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $producto->subcategoria->nombre_subcategoria }}</span>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $producto->marca->nombre_marca }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $producto->nombre_producto }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">$
                                                        {{ $producto->precio_de_compra }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">$
                                                        {{ $producto->precio_de_venta }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $producto->unidades_disponibles }}</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn bg-gradient-info mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-{{ $producto->id }}">
                                                        <img src="{{ asset('images/icons/icon-edit.svg') }}" alt="edit"
                                                            width="30px">
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn bg-gradient-danger mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-default-{{ $producto->id }}">
                                                        <img src="{{ asset('images/icons/icon-delete.svg') }}"
                                                            alt="delete" width="30px">
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn bg-gradient-warning mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-detalle-{{ $producto->id }}">
                                                        <img src="{{ asset('images/icons/icon-detalle.svg') }}"
                                                            alt="delete" width="30px">
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12">No se encontraron productos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Alerta de éxito --}}
                    @if (session('mensaje'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> {{ session('mensaje') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@push('modals')
    @foreach ($productos as $producto)
        <!-- The Modal delete -->
        <div class="modal fade" id="modal-default-{{ $producto->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-{{ $producto->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default-{{ $producto->id }}">¿Estás seguro de eliminar el
                            producto <span class="modal-edit-name">{{ $producto->nombre_producto }}</span>?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle the category deletion -->
                        <form action="{{ route('eliminar-producto', $producto->id) }}" method="POST">
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

        {{-- Modal para editar --}}
        <div class="modal fade" id="modal-edit-{{ $producto->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-edit-{{ $producto->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-edit-{{ $producto->id }}">¿Seguro qué quieres editar
                            el producto <span class="modal-edit-name">{{ $producto->nombre_producto }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('editar-producto-update', $producto->id) }}">
                            <button type="button" class="btn bg-gradient-info">SI</button>
                        </a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para ver detalles --}}
        <div class="modal fade" id="modal-detalle-{{ $producto->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-detalle-{{ $producto->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-detalle-{{ $producto->id }}">¿Seguro qué quieres mirar
                            el producto <span class="modal-edit-name">{{ $producto->nombre_producto }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="#">
                            <button type="button" class="btn bg-gradient-info">SI</button>
                        </a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
@endpush
