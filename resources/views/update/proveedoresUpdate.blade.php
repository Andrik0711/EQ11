@extends('layouts.user_type.auth')


@section('title', 'Actualizar proveedor')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid my-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Actualizar proveedor</h6>
                        <div class="d-flex justify-end">
                            {{-- Boton de regresar --}}
                            <a href="{{ route('mostrar-proveedores') }}" class="btn bg-gradient-primary mt-4 mx-2">
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
                                    {{-- Formulario para registrar un proveedor --}}
                                    <form action="{{ route('editar-proveedor-update', $proveedor->id) }}" method="POST"
                                        novalidate>

                                        @csrf
                                        @method('PUT')

                                        {{-- Nombre del proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- Label --}}
                                                <label for="nombre_proveedor">Nombre del proveedor</label>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Nombre del proveedor"
                                                    class="form-control" id="nombre_proveedor" name="nombre_proveedor"
                                                    value="{{ $proveedor->nombre_proveedor }}" />

                                                {{-- Mensaje de error --}}
                                                @error('nombre_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Codigo del proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <label for="codigo_proveedor">Código del proveedor</label>
                                                {{-- Input --}}
                                                <input type="text" placeholder="Código del provedor" class="form-control"
                                                    id="codigo_proveedor" name="codigo_proveedor"
                                                    value="{{ $proveedor->codigo_proveedor }}" />

                                                {{-- Mensaje de error --}}
                                                @error('codigo_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Telefono del proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <label for="telefono_proveedor">Teléfono del proveedor</label>
                                                {{-- Input --}}
                                                <input type="number" placeholder="Teléfono del provedor"
                                                    class="form-control" id="telefono_proveedor" name="telefono_proveedor"
                                                    value="{{ $proveedor->telefono_proveedor }}" />

                                                {{-- Mensaje de error --}}
                                                @error('telefono_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email del proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                {{-- Label --}}
                                                <label for="email_proveedor">Email del proveedor</label>
                                                {{-- Input --}}
                                                <input type="email" placeholder="Email del provedor" class="form-control"
                                                    id="email_proveedor" name="email_proveedor"
                                                    value="{{ $proveedor->email_proveedor }}" />

                                                {{-- Mensaje de error --}}
                                                @error('email_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>



                                        {{-- Campo oculto el cual pasa el nombre de quien creo al proveedor --}}
                                        <input type="hidden" id="proveedor_creado_por" name="proveedor_creado_por"
                                            value="{{ $proveedor->proveedor_creado_por }}">



                                        <!--
                                                                    {{-- Select para el pais del proveedor --}}
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            {{-- Label --}}
                                                                            <h6 for="pais_proveedor">Seleccione una pais</h6>
                                                                            {{-- Select --}}
                                                                            <select class="form-control" id="pais_proveedor" name="pais_proveedor">
                                                                                <option value="{{ $proveedor->id }}">{{ $proveedor->pais_proveedor }}
                                                                                </option>
                                                                                {{-- @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"
                                                            @if ($subcategoria->pais_proveedor == $categoria->id) selected @endif>
                                                            {{ $categoria->nombre_categoria }}</option>
                                                    @endforeach --}}
                                                                            </select>

                                                                            {{-- Mensaje de error --}}
                                                                            @error('pais_proveedor')
        <small class="text-danger">{{ $message }}</small>
    @enderror
                                                                        </div>
                                                                    </div> -->




                                        {{-- Select para el pais del proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="pais_proveedor">País del proveedor</h6>
                                                <select class="form-control" id="pais_proveedor" name="pais_proveedor">
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->pais_proveedor }}
                                                    </option>
                                                    {{-- Opciones de países se agregarán dinámicamente con JavaScript --}}
                                                </select>
                                                {{-- Mensaje de error --}}
                                                @error('pais_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Select para el estado del proveedor dependiendo el pais --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="estado_proveedor">Estado del proveedor</h6>
                                                <select class="form-control" id="estado_proveedor" name="estado_proveedor">
                                                    <option value="{{ $proveedor->id }}">
                                                        {{ $proveedor->estado_proveedor }}
                                                    </option>
                                                    {{-- Opciones de estados se agregarán dinámicamente con JavaScript --}}
                                                </select>
                                                {{-- Mensaje de error --}}
                                                @error('estado_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>





                                        <!--
                                                                {{-- Select para el estado del proveedor --}}
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{-- Label --}}
                                                                        <h6 for="estado_proveedor">Seleccione un estado</h6>
                                                                        {{-- Select --}}
                                                                        <select class="form-control" id="estado_proveedor" name="estado_proveedor">
                                                                            <option value="{{ $proveedor->id }}">
                                                                                {{ $proveedor->estado_proveedor }}
                                                                            </option>
                                                                            {{-- @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"
                                                            @if ($subcategoria->estado_proveedor == $categoria->id) selected @endif>
                                                            {{ $categoria->nombre_categoria }}</option>
                                                    @endforeach --}}
                                                                        </select>

                                                                        {{-- Mensaje de error --}}
                                                                        @error('estado_proveedor')
        <small class="text-danger">{{ $message }}</small>
    @enderror
                                                                    </div>
                                                                </div> -->

                                        {{-- Direccion del proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6 for="direccion_proveedor">Dirección del proveedor</h6>
                                                <input type="text" placeholder="Dirección del proveedor"
                                                    class="form-control" id="direccion_proveedor"
                                                    name="direccion_proveedor"
                                                    value="{{ $proveedor->direccion_proveedor }}" />
                                                @error('direccion_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Descripcion del proveedor --}}
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <h6 for="descripcion_proveedor">Descripción del proveedor</h6>
                                                <textarea class="form-control" id="descripcion_proveedor" name="descripcion_proveedor" rows="3"
                                                    placeholder="Descripción del proveedor">{{ $proveedor->descripcion_proveedor }}</textarea>
                                                @error('descripcion_proveedor')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Imagen actual de la proveedor --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Imagen actual</h6>
                                                <div
                                                    class=" d-flex justify-content-center items-content-center align-middle">
                                                    <img class="border-radius-lg"
                                                        src="{{ asset('proveedores/' . $proveedor->imagen_proveedor) }}"
                                                        alt="imagen actual del proveedor" width="150">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Campo oculto para la imagen actual (si deseas mantener la imagen actual) --}}
                                        <input type="hidden" name="imagen_actual"
                                            value="{{ $proveedor->imagen_proveedor }}" />

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
                                            value="Registrar proveedor">
                                            Actualizar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- Right Column - Dropzone para cargar imagen --}}
                            <div class="col">
                                <div class="form-group mt-4">
                                    <form action="{{ route('proveedor-image-store') }}" method="POST"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


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

        $(document).ready(function() {
            const geonamesUsername = 'chris_laravel'; // Reemplaza con tu nombre de usuario de Geonames

            // Obtener la lista de países desde la API
            $.get('https://restcountries.com/v2/all', function(data) {
                const paises = data.map(function(pais) {
                    return {
                        id: pais.name,
                        text: pais.name,
                        latlng: pais.latlng // Agregar latitud y longitud a los datos del país
                    };
                });

                // Inicializar el select2 con la lista de países
                $('#pais_proveedor').select2({
                    data: paises,
                    placeholder: 'Seleccione el país',
                    allowClear: true,
                    width: '100%',
                });

                // Manejar el cambio de país seleccionado para proveedor
                $('#pais_proveedor').on('change', function() {
                    const selectedCountry = $(this).select2('data')[0];

                    // Verificar si se tiene información de latitud y longitud del país
                    if (selectedCountry && selectedCountry.latlng && geonamesUsername) {
                        const lat = selectedCountry.latlng[0];
                        const lng = selectedCountry.latlng[1];

                        // Realizar una solicitud AJAX para obtener los estados del país seleccionado desde Geonames
                        const url =
                            `http://api.geonames.org/countrySubdivision?lat=${lat}&lng=${lng}&maxRows=10000&radius=200&username=${geonamesUsername}`;

                        $.ajax({
                            url: url,
                            dataType: "xml",
                            success: function(response) {
                                const estados = [];
                                $(response).find('countrySubdivision').each(function() {
                                    const estado = {
                                        id: $(this).find('adminName1')
                                            .text(),
                                        text: $(this).find('adminName1')
                                            .text()
                                    };
                                    estados.push(estado);
                                });

                                // Llenar el select de estados con los datos obtenidos
                                $('#estado_proveedor').empty().trigger('change');
                                $('#estado_proveedor').select2({
                                    data: estados,
                                    placeholder: 'Seleccione el estado',
                                    allowClear: true,
                                    width: '100%',
                                });

                                // Actualizar el valor seleccionado en el campo de estado del proveedor
                                const selectedState = $('#estado_proveedor').val();
                                if (selectedState) {
                                    $('#estado_proveedor').val(selectedState).trigger(
                                        'change');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(errorThrown);
                            }
                        });
                    } else {
                        // Si no se tiene la clave de acceso o no se ha seleccionado un país con latitud y longitud, limpiar el select de estados
                        $('#estado_proveedor').empty().trigger('change');
                    }
                });
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
