@extends('layouts.user_type.auth')

@section('title', 'Registrar marca')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Formulario para registrar marcas</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-marcas') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                Regresar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-2 pb-2">
                    <div class="px-4 flex">
                        {{-- Left Column - Formulario para registrar una marca --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <form action="{{ route('registrar-marca-store') }}" method="POST" novalidate>
                                        @csrf
                                        {{-- Nombre de la marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="nombre_marca">Nombre de la Marca</h6>
                                                <input type="text" placeholder="Nombre de la Marca" class="form-control"
                                                    id="nombre_marca" name="nombre_marca"
                                                    value="{{ old('nombre_marca') }}" />
                                                @error('nombre_marca')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Descripcion de marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="descripcion_marca">Descripción de la Marca</h6>
                                                <input type="text" placeholder="Descripción de la Marca"
                                                    class="form-control" id="descripcion_marca" name="descripcion_marca"
                                                    value="{{ old('descripcion_marca') }}" />
                                                @error('descripcion_marca')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Campo oculto para la imagen --}}
                                        <div class="col-md-6">
                                            <input name="imagen" id="imagen" type="hidden"
                                                value="{{ old('value') }}" />
                                            @error('imagen')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Campo oculto el cual pasa el nombre de quien creo la categoria --}}
                                        <input type="hidden" id="marca_creada_por" name="marca_creada_por"
                                            value="{{ auth()->user()->name }}" />

                                        {{-- Boton para enviar el registro de sub categoria --}}
                                        <button class="btn bg-gradient-success" type="submit"
                                            value="Registrar Marca">Enviar</button>
                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group mt-4">
                                    <form action="{{ route('marca-image-store') }}" method="POST"
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
            {{-- Alerta de éxito --}}
            @if (session('mensaje'))
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> {{ session('mensaje') }}
                </div>
            @endif
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
                        '/marcas/${imagenPublicada.name}'
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
