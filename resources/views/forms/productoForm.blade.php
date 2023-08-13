@extends('layouts.user_type.auth')

@section('title', 'Registrar Producto')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Formulario para registrar productos</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-productos') }}" class="btn bg-gradient-primary mt-4 mx-2">
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
                                    <form action="{{ route('registrar-producto-store') }}" method="POST" novalidate>

                                        @csrf
                                        {{-- Seleccion de la categoria --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="id_categoria_producto">Seleccione una categoría</h6>
                                                <select class="form-control select2" id="id_categoria_producto"
                                                    name="id_categoria_producto">
                                                    <option value="">Seleccione una categoría</option>
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}">
                                                            {{ $categoria->nombre_categoria }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_categoria_producto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Seleccion de la subcategoria --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="id_subcategoria_producto">Seleccione una Sub categoría</h6>
                                                <select class="form-control select2" id="id_subcategoria_producto"
                                                    name="id_subcategoria_producto">
                                                    <option value="">Seleccione una sub categoría</option>
                                                </select>
                                                @error('id_subcategoria_producto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>



                                        {{-- Seleccion de la marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="id_marca_producto">Seleccione una marca</h6>
                                                {{-- Select con la clase select2 --}}
                                                <select class="form-control" id="id_marca_producto"
                                                    name="id_marca_producto">
                                                    <option value="">Seleccione una marca</option>
                                                    @foreach ($marcas as $marca)
                                                        <option value="{{ $marca->id }}">
                                                            {{ $marca->nombre_marca }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- Mensaje de error --}}
                                                @error('id_marca_producto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>


                                        {{-- Nombre del producto --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="nombre_producto">Nombre del producto</h6>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Nombre del producto" class="form-control"
                                                    id="nombre_producto" name="nombre_producto"
                                                    value="{{ old('nombre_producto') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('nombre_producto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Descripción del producto --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="descripcion_producto">Descripción del producto</h6>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Descripción del producto"
                                                    class="form-control" id="descripcion_producto"
                                                    name="descripcion_producto"
                                                    value="{{ old('descripcion_producto') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('descripcion_producto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Precio de compra --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="precio_de_compra">Precio de compra</h6>
                                                {{-- Input --}}
                                                <input type="number" placeholder="Precio de compra" class="form-control"
                                                    id="precio_de_compra" name="precio_de_compra"
                                                    value="{{ old('precio_de_compra') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('precio_de_compra')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Precio de venta --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="precio_de_venta">Precio de venta</h6>
                                                {{-- Input --}}
                                                <input type="number" placeholder="Precio de venta" class="form-control"
                                                    id="precio_de_venta" name="precio_de_venta"
                                                    value="{{ old('precio_de_venta') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('precio_de_venta')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Unidades disponibles --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="unidades_disponibles">Unidades disponibles</h6>
                                                {{-- Input --}}
                                                <input type="number" placeholder="Unidades disponibles"
                                                    class="form-control" id="unidades_disponibles"
                                                    name="unidades_disponibles"
                                                    value="{{ old('unidades_disponibles') }}" />

                                                {{-- Mensaje de error --}}
                                                @error('unidades_disponibles')
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
                                        <input type="hidden" id="producto_creado_por" name="producto_creado_por"
                                            value="{{ auth()->user()->name }}">

                                        {{-- Boton para enviar el registro de Producto --}}
                                        <button class="btn bg-gradient-success" type="submit"
                                            value="Registrar Producto">
                                            Enviar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group mt-4">
                                    <form action="{{ route('producto-image-store') }}" method="POST"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
                        '/productos/${imagenPublicada.name}'
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

    <script>
        $(document).ready(function() {
            // Inicializar el plugin Select2 en el select de categorías
            $('.select2').select2();

            // Cargar las subcategorías dependiendo de la categoría seleccionada
            $('#id_categoria_producto').on('change', function() {
                var categoriaId = $(this).val();

                // Realizar una petición AJAX para obtener las subcategorías de la categoría seleccionada
                $.ajax({
                    url: '/api/subcategorias/' +
                        categoriaId, // Ruta para obtener las subcategorías
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Limpiar el select de subcategorías
                        $('#id_subcategoria_producto').empty();

                        // Agregar las opciones correspondientes a las subcategorías
                        $.each(data, function(index, subcategoria) {
                            $('#id_subcategoria_producto').append(
                                $('<option></option>').attr('value', subcategoria
                                    .id).text(subcategoria.nombre_subcategoria)
                            );
                        });

                        // Actualizar el plugin Select2 para reflejar los cambios
                        $('#id_subcategoria_producto').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>



    {{-- Modales --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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
