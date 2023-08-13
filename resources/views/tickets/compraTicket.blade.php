@extends('layouts.user_type.auth')

@section('title', 'Ticket')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-2">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h6 class="mb-0">Detalle de compra</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para imprimir --}}
                                    {{-- <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print"
                                            width="30px">
                                    </a> --}}

                                    {{-- Imagen para exportar pdf --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                                    </a>

                                    {{-- Imagen para exportar XML --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                                    </a>

                                    {{-- Boton de agregar productos --}}
                                    <a href="{{ route('mostrar-compras') }}"
                                        class="d-flex btn bg-gradient-primary mt-4 align-content-center">
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="container mx-4">
                                <div class="row ">
                                    <div class="col">
                                        <h6 class="mb-1">Información del proveedor</h6>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Nombre:</span>
                                            <span class="text-secondary text-xs font-weight-bold ">
                                                {{ $compra_realizada->proveedor->nombre_proveedor }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Dirección:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $compra_realizada->proveedor->direccion_proveedor }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Teléfono:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $compra_realizada->proveedor->telefono_proveedor }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Correo:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $compra_realizada->proveedor->email_proveedor }}</span>
                                        </p>
                                    </div>

                                    <div class="col"> </div>

                                    <div class="col">
                                        <h6 class="mb-1">Información de la compra</h6>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Código:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $compra_realizada->id }}</span>
                                        </p>

                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Estado:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $compra_realizada->compra_status }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Productos:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $compra_realizada->compra_productos_comprados }}</span>
                                        </p>

                                        {{-- <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Resta:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                $ {{ $compra_realizada->venta_subtotal }}</span>
                                        </p> --}}

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive p-0">
                                <table id="productos-table" class="table align-items-center mb-0 text-center">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="check-all">
                                                </div>
                                            </th> --}}
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Producto </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Unidades</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio unitario</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Subtotal</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                IVA</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($compra_realizada->productos as $producto)
                                            <tr>
                                                {{-- <td>
                                                    <!-- Checkbox for each row -->
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input checkbox-item" type="checkbox"
                                                            id="check-{{ $compra_realizada->id }}">
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('productos') . '/' . $producto->imagen_producto }}"
                                                                class="me-3 rounded-3 ms-4" width="100px"
                                                                alt="{{ $producto->nombre_producto }}">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $producto->nombre_producto }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $producto->pivot->cantidad_comprada }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ number_format($producto->pivot->precio_unitario, 2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ number_format($producto->pivot->subtotal, 2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ number_format($producto->pivot->subtotal * 0.16, 2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $
                                                        {{ number_format($producto->pivot->subtotal + $producto->pivot->subtotal * 0.16, 2) }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No se encontraron compras</td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <td colspan="5" class="text-end">
                                                <p class="text-sm font-weight-bold mb-0">Costo final:</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    $ {{ number_format($compra_realizada->compra_total, 2) }}
                                                </p>
                                            </td>
                                        </tr>
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
