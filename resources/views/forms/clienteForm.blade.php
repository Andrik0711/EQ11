@extends('layouts.user_type.auth')

@section('title', 'Registrar cliente')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Formulario para registrar cliente</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-clientes') }}" class="btn bg-gradient-primary mt-4 mx-2">
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

                                    {{-- Formulario para registrar una categoria --}}
                                    <form action="{{ route('registrar-cliente-store') }}" method="POST" novalidate>

                                        @csrf
                                        {{-- Nombre del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="nombre_cliente">Nombre del cliente</h6>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Nombre del cliente" class="form-control"
                                                    id="nombre_cliente" name="nombre_cliente"
                                                    value="{{ old('nombre_cliente') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('nombre_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Codigo del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <h6 for="codigo_cliente">Código del cliente</h6>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Código del cliente" class="form-control"
                                                    id="codigo_cliente" name="codigo_cliente"
                                                    value="{{ old('codigo_cliente') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('codigo_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Telefono del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <h6 for="telefono_cliente">Teléfono del cliente</h6>
                                                {{-- Input --}}
                                                <input type="number" placeholder="Teléfono del cliente"
                                                    class="form-control" id="telefono_cliente" name="telefono_cliente"
                                                    value="{{ old('telefono_cliente') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('telefono_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <h6 for="email_cliente">Email del cliente</h6>
                                                {{-- Input --}}
                                                <input type="email" placeholder="Email del cliente" class="form-control"
                                                    id="email_cliente" name="email_cliente"
                                                    value="{{ old('email_cliente') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('email_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Empresa del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <h6 for="empresa_cliente">Empresa del cliente</h6>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Empresa del cliente" class="form-control"
                                                    id="empresa_cliente" name="empresa_cliente"
                                                    value="{{ old('empresa_cliente') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('empresa_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Campo oculto el cual pasa el nombre de quien creo al cliente --}}
                                        <input type="hidden" id="cliente_creado_por" name="cliente_creado_por"
                                            value="{{ auth()->user()->name }}">

                                        {{-- Select para el pais del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="pais_cliente">País del cliente</h6>
                                                <select class="form-control" id="pais_cliente" name="pais_cliente">
                                                    <option value="">Seleccione el país</option>
                                                    {{-- Agregar opciones de países aquí --}}
                                                    <option value="pais1">País 1</option>
                                                    <option value="pais2">País 2</option>
                                                    {{-- Agregar más opciones si es necesario --}}
                                                </select>
                                                {{-- Mensaje de error --}}
                                                @error('pais_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Select para el estado del cliente dependiendo el pais --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="estado_cliente">Estado del cliente</h6>
                                                <select class="form-control" id="estado_cliente" name="estado_cliente">
                                                    <option value="">Seleccione el estado</option>
                                                    <option value="estado1">Estado 1</option>
                                                    <option value="estado2">Estado 2</option>

                                                </select>
                                                {{-- Mensaje de error --}}
                                                @error('estado_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Dirección del cliente --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="direccion_cliente">Dirección del cliente</h6>
                                                <input class="form-control" id="direccion_cliente" name="direccion_cliente"
                                                    rows="3"
                                                    placeholder="Dirección del cliente">{{ old('direccion_cliente') }}</input>
                                                {{-- Mensaje de error --}}
                                                @error('direccion_cliente')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Descripcion del cliente --}}
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <h6 for="descripcion_cliente">Descripción del cliente</h6>
                                                <textarea class="form-control" id="descripcion_cliente" name="descripcion_cliente" rows="3"
                                                    placeholder="Descripción del cliente">{{ old('descripcion_cliente') }}</textarea>
                                                {{-- Mensaje de error --}}
                                                @error('descripcion_cliente')
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


                                        {{-- Boton para enviar el registro de categoria --}}
                                        <button class="btn bg-gradient-success" type="submit"
                                            value="Registrar Categoria">
                                            Enviar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group mt-4">
                                    <form action="{{ route('cliente-image-store') }}" method="POST"
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
                    imagenPublicada.size = 4000;
                    imagenPublicada.name = document.querySelector('[name= "imagen"]').value;
                    this.options.addedfile.call(this, imagenPublicada);
                    this.options.thumbnail.call(
                        this,
                        imagenPublicada.name,
                        '/clientes/${imagenPublicada.name}'
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
