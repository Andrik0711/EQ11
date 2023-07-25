@extends('layouts.user_type.auth')

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
                                <h6 class="mb-0">Tabla de Categorias</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para exportar pdf --}}
                                    <a href="" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                                    </a>

                                    {{-- Imagen para exportar XML --}}
                                    <a href="" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                                    </a>

                                    {{-- Boton de agregar categorias --}}
                                    <a href="{{ route('registrar-categoria-form') }}"
                                        class="btn bg-gradient-primary mt-4 mx-2 d-flex align-items-center">Agregar
                                        categoria</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="categorias-table" class="table align-items-center mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Creada por</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ID</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nombre</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Código</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Descripción</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Creada</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Editar</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categorias as $categoria)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center px-2 py-1">
                                                        <div>
                                                            <img src="../assets/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $categoria->categoria_creada_por }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $categoria->id }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $categoria->nombre_categoria }}</p>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $categoria->codigo_categoria }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $categoria->descripcion_categoria }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $categoria->created_at->format('d/m/Y') }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('editar-categoria-update', $categoria->id) }}"
                                                        class="btn bg-gradient-info mt-3">Editar</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('eliminar-categoria', $categoria->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn bg-gradient-danger mt-3"
                                                            onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No se encontraron categorías</td>
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


@push('scripts')
    {{-- Agregamos del cdn de datatable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable with drawCallback and language options
            $('#categorias-table').DataTable({
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
