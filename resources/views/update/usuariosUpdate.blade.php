@extends('layouts.user_type.auth')

@section('title', 'Actualizar usuarios')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
@endpush


@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        {{-- Alerta de éxito --}}
        @if (session('mensaje'))
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> {{ session('mensaje') }}
            </div>
        @endif

        <div class="container-fluid my-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Actualizar usuario</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-usuarios') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <div class="px-4 flex">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{-- Formulario para registrar o actualizar una subcategoría --}}
                                    <form action="{{ route('editar-usuario-update', $user->id) }}" method="POST"
                                        novalidate>
                                        @csrf
                                        @method('PUT')

                                        {{-- Nombre del usuario --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nombre del usuario</label>
                                                <input type="text" placeholder="Nombre del usuario" class="form-control"
                                                    id="name" name="name" value="{{ old('name', $user->name) }}" />
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Apellido del usuario --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido">Apellido del usuario</label>
                                                <input type="text" placeholder="Apellido del usuario"
                                                    class="form-control" id="apellido" name="apellido"
                                                    value="{{ old('apellido', $user->apellido) }}" />
                                                @error('apellido')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Username --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" placeholder="Username" class="form-control"
                                                    id="username" name="username"
                                                    value="{{ old('username', $user->username) }}" />
                                                @error('username')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Telefono --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input type="number" placeholder="Apellido del usuario"
                                                    class="form-control" id="telefono" name="telefono"
                                                    value="{{ old('telefono', $user->telefono) }}" />
                                                @error('telefono')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" placeholder="Apellido del usuario"
                                                    class="form-control" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}" />
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" placeholder="password" class="form-control"
                                                    id="password" name="password"
                                                    value="{{ old('password', $user->password) }}" />
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Rol --}}
                                        <div class="col-md-6">
                                            <label class="mb-2">Rol:</label>
                                            <select class="form-select" name="rol" required>
                                                <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="usuario" {{ $user->rol === 'usuario' ? 'selected' : '' }}>
                                                    Usuario</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Imagen actual</h6>
                                                <div
                                                    class=" d-flex justify-content-center items-content-center align-middle">
                                                    <img class="border-radius-lg"
                                                        src="{{ asset('usuarios/' . $user->imagen_usuario) }}"
                                                        alt="imagen actual" width="150">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Campo oculto para la imagen actual (si deseas mantener la imagen actual) --}}
                                        <input type="hidden" name="imagen_actual" value="{{ $user->imagen_usuario }}" />

                                        {{-- Campo oculto para la imagen nueva --}}
                                        <div class="col-md-6">
                                            <input name="imagen" id="imagen" type="hidden"
                                                value="{{ old('value') }}" />
                                            @error('imagen')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        {{-- Boton para enviar el registro de subcategoría --}}
                                        <button class="btn bg-gradient-success" type="submit"
                                            value="Actualizar Subcategoría">
                                            Actualizar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group">
                                    <h6>Actualizar usuario</h6>
                                    <form action="{{ route('usuario-image-store') }}" method="POST"
                                        enctype="multipart/form-data" id="cargar_imagen"
                                        class="dropzone d-flex justify-content-center items-content-center align-middle border border-success">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
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
    </script>
@endpush
