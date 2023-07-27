@extends('layouts.user_type.auth')

@section('title', 'Actualizar producto')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Actualizar producto</h6>
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
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{-- Formulario para editar un producto --}}
                                    <form action="{{ route('editar-producto-update', $producto->id) }}" method="POST"
                                        novalidate>

                                        @csrf
                                        @method('PUT')

                                        {{-- Seleccion de la categoria --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="id_categoria_producto">Seleccione una categoría</h6>
                                                {{-- Select --}}
                                                <select class="form-control" id="id_categoria_producto"
                                                    name="id_categoria_producto">
                                                    <option value="">Seleccione una categoría</option>
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"
                                                            @if ($categoria->id == $producto->id_categoria_producto) selected @endif>
                                                            {{ $categoria->nombre_categoria }}</option>
                                                    @endforeach
                                                </select>

                                                {{-- Mensaje de error --}}
                                                @error('id_categoria_producto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Seleccion de la sub categoria --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <h6 for="id_subcategoria_producto">Seleccione una Sub categoría</h6>
                                                {{-- Select --}}
                                                <select class="form-control" id="id_subcategoria_producto"
                                                    name="id_subcategoria_producto">
                                                    <option value="">Seleccione una categoría</option>
                                                    @foreach ($subcategorias as $subcategoria)
                                                        <option value="{{ $subcategoria->id }}"
                                                            @if ($subcategoria->id == $producto->id_subcategoria_producto) selected @endif>
                                                            {{ $subcategoria->nombre_subcategoria }}</option>
                                                    @endforeach
                                                </select>

                                                {{-- Mensaje de error --}}
                                                @error('id_subcategoria_producto')
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
                                                    value="{{ $producto->nombre_producto }}" />

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
                                                    value="{{ $producto->descripcion_producto }}" />

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
                                                    value="{{ $producto->precio_de_compra }}" />

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
                                                    value="{{ $producto->precio_de_venta }}" />

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
                                                    value="{{ $producto->unidades_disponibles }}" />

                                                {{-- Mensaje de error --}}
                                                @error('unidades_disponibles')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Imagen actual de la marca --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Imagen actual</h6>
                                                <div
                                                    class=" d-flex justify-content-center items-content-center align-middle">
                                                    <img class="border-radius-lg"
                                                        src="{{ asset('productos/' . $producto->imagen_producto) }}"
                                                        alt="imagen actual de la marca" width="150">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Campo oculto para la imagen actual (si deseas mantener la imagen actual) --}}
                                        <input type="hidden" name="imagen_actual"
                                            value="{{ $producto->imagen_producto }}" />

                                        {{-- Campo oculto para la imagen nueva --}}
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

                                        {{-- Boton para enviar la actualización del Producto --}}
                                        <button class="btn bg-gradient-success" type="submit"
                                            value="Actualizar Producto">
                                            Actualizar
                                        </button>

                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group">
                                    <h6>Actualizar imagen</h6>
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
@endpush
