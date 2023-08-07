@extends('layouts.user_type.auth')

@section('title', 'Usuarios')

@push('styles')
    {{-- Agregamos del cdn de datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    {{-- Estilos para el dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />

    {{-- Referenciamos los estilos de app.css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        {{-- Alerta de éxito --}}
        @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> {{ session('mensaje') }}
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-2">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h6 class="mb-0">Tabla de usuarios</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para imprimir --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-printer.svg') }}" alt="print"
                                            width="30px">
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
                                    <a href="{{ route('registrar-usuario-form') }}" class="btn bg-gradient-primary mt-4">
                                        <img src="{{ asset('images/icons/icon-add.svg') }}" alt="add"
                                            width="30px">Agregar usuarios
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="usuarios-table" class="table align-items-center mb-0 text-center">
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
                                                Nombre</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Apellido</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Username</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Teléfono</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Rol</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Editar</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>
                                                    <!-- Checkbox for each row -->
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input checkbox-item" type="checkbox"
                                                            id="check-{{ $user->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1 ">
                                                        <div>
                                                            <img src="{{ asset('usuarios') . '/' . $user->imagen_usuario }}"
                                                                alt="{{ $user->name }}" width="50px"
                                                                class="border-radius-lg">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center px-2">
                                                            <h6 class="mb-0 text-sm">{{ $user->name }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $user->apellido }}</p>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $user->username }}</span>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $user->telefono }}</span>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->email }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->rol }}</span>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn bg-gradient-info mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-{{ $user->id }}">
                                                        <img src="{{ asset('images/icons/icon-edit.svg') }}" alt="edit"
                                                            width="30px">
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn bg-gradient-danger mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-default-{{ $user->id }}">
                                                        <img src="{{ asset('images/icons/icon-delete.svg') }}"
                                                            alt="delete" width="30px">
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">No se encontraron usuarios</td>
                                            </tr>
                                        @endforelse
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
    @foreach ($users as $user)
        <!-- The Modal delete -->
        <div class="modal fade" id="modal-default-{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default-{{ $user->id }}">¿Estás seguro de eliminar al
                            usuario
                            <span class="modal-edit-name">{{ $user->name }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle the category deletion -->
                        <form action="{{ route('eliminar-usuario', $user->id) }}" method="POST">
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
        <div class="modal fade" id="modal-edit-{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-edit-{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-edit-{{ $user->id }}">¿Seguro qué quieres editar
                            el usuario <span class="modal-edit-name">{{ $user->name }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('editar-usuario', $user->id) }}">
                            <button type="button" class="btn bg-gradient-info">SI</button>
                        </a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para editar usuarios --}}
        {{-- <div class="modal fade" id="modal-edit-user-{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-edit-user-{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">Editar usuario</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('editar-usuario-update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-2">Nombre:</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-2">Apellido:</label>
                                            <input type="text" class="form-control" name="apellido"
                                                value="{{ $user->apellido }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-2">Nombre de usuario:</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{ $user->username }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-2">Correo electrónico:</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-2">Teléfono:</label>
                                            <input type="tel" class="form-control" name="telefono"
                                                value="{{ $user->telefono }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-2">Rol:</label>
                                            <select class="form-select" name="rol" required>
                                                <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="usuario" {{ $user->rol === 'usuario' ? 'selected' : '' }}>
                                                    Usuario</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="imagen_actual"
                                            value="{{ $user->imagen_usuario }}" />

                                        <div class="col-md-6">
                                            <input name="imagen" id="imagen" type="hidden"
                                                value="{{ old('value') }}" />
                                            @error('imagen')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Guardar</button>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-evenly">

                                    <div class="form-group mt-2">
                                        <h6>Actualizar imagen</h6>
                                        <form action="{{ route('usuario-image-store') }}" method="POST"
                                            enctype="multipart/form-data" id="cargar_imagen"
                                            class="dropzone d-flex justify-content-center items-content-center align-middle border border-success">
                                            @csrf
                                        </form>
                                    </div>

                                    <div class="form-group mt-2">
                                        <h6>Imagen actual</h6>
                                        <div class=" d-flex justify-content-center items-content-center align-middle">
                                            <img class="border-radius-lg"
                                                src="{{ asset('usuarios/' . $user->imagen_usuario) }}"
                                                alt="imagen actual de la marca" width="150">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
            $('#users-table').DataTable({
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

    {{-- Script para dropzone --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script>
        // Codigo para cargar Dropzone en la carpeta /categorias
        Dropzone.autoDiscover = false;
        // iniciarDropzoneCategorias();
        const subir_imagen_categorias = new Dropzone('#cargar_imagen', {
            dictDefaultMessage: 'Suba tú imagen aquí',
            acceptedFiles: ".png,.jpg,.jpeg",
            addRemoveLinks: true,
            dictRemoveFile: "Borrar archivo",
            maxFiles: 1,
            uploadMultiple: false,
            // Trabajando con imagen en el contenedor de dropzone
            init: function() {
                if (document.querySelector('[name= "imagen"]').value.trim()) {
                    const imagenPublicada = {};
                    imagenPublicada.size = 2000;
                    imagenPublicada.name = document.querySelector('[name= "imagen"]').value;
                    this.options.addedfile.call(this, imagenPublicada);
                    this.options.thumbnail.call(
                        this,
                        imagenPublicada.name,
                        '/usuarios/${imagenPublicada.name}'
                    );
                    imagenPublicada.previewElement.classList.add(
                        "dz-sucess",
                        "dz-complete"
                    )
                }
            }
        });

        // Evento de envío de correo correcto
        subir_imagen_categorias.on('success', function(file, response) {
            document.querySelector('[name= "imagen"]').value = response.imagen;
        });

        // Envío cuando hay error
        subir_imagen_categorias.on('error', function(file, message) {
            console.log(message);
        });

        // Remover un archivo
        subir_imagen_categorias.on('removedfile', function() {
            document.querySelector('[name= "imagen"]').value = "";
        });
    </script> --}}
@endpush
