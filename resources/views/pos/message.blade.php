@extends('layouts.appDashboard')

@push('styles')
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
<!-- Main Styling -->
<link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
<style>
    .btn-custom {
        background-color: #5f5afa;
        color: white;
    }
</style>
@endpush

@push('scripts')
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
@endpush

@section('titulo')
Ventas
@endsection

@section('main')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div >
                    {{-- INICIO --}}
                    <div class="flex">
                        <div style="width: 60%;">
                            <!-- Filtros -->
                            <form method="GET" action="{{ route('ventas.form') }}" class="flex flex-wrap justify-between px-4">
                                <div class="flex-grow my-2 mr-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nombre" placeholder="Nombre del producto">
                                </div>
                                <div class="flex-grow my-2 mr-2">
                                    <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="categoria_id">
                                        <option value="">Categoría</option>
                                        @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow my-2 mr-2">
                                    <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="subcategoria_id">
                                        <option value="">Subcategoría</option>
                                        @foreach($subcategorias as $subcategoria)
                                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow my-2 mr-2">
                                    <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="marca_id">
                                        <option value="">Marca</option>
                                        @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow my-2 mr-2">
                                    <button class="btn-custom w-full py-2 px-4 rounded focus:outline-none" type="submit">Filtrar</button>
                                </div>
                            </form>

                            <!-- Listado de productos -->
                            <div class="flex flex-wrap">
                                @foreach($productos as $producto)
                                <form style="width: 30%;" method="POST" action="{{ route('ventas.agregar') }}">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <div class="flex flex-col items-center shadow rounded bg-gray-100 hover:bg-gray-200 transition-colors duration-200 product-card cursor-pointer">
                                        <img style="width: 80%; margin-top: 10px;" class="h-64 object-cover rounded" src="{{ asset('uploads/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                                        <h2 class="mt-4 text-xl font-semibold text-gray-700">{{ $producto->nombre }}</h2>
                                        <p class="mt-2 text-gray-600">${{ $producto->precio_venta }}</p>
                                    </div>
                                </form>
                                @endforeach
                            </div>


                        </div>

                        <div class="width:40%;">
                            <!-- Carrito -->
                            <h3 class="pl-6 pt-6 text-2xl font-semibold text-gray-700">Carrito</h3>
                            <div class="p-6 grid grid-cols-1 gap-6">
                                <div style="max-height: 40vh; overflow-y: auto;" class="grid grid-cols-1 gap-6">
                                    @php
                                        $carrito = session()->get('carrito', []);
                                        $subtotal = 0;
                                    @endphp
                                    @foreach($carrito as $producto_id => $producto)
                                    <div class="shadow p-4 rounded flex items-center justify-between">
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-700">{{ $producto['cantidad'] }} x {{ $producto['nombre'] }}</h2>

                                            <p class="text-gray-600">                                                ${{ $producto['precio'] * $producto['cantidad'] }}</p>
                                        </div>
                                        <img src="{{ asset('uploads/'.$producto['imagen']) }}" alt="Product Image" class="h-10 w-10 object-cover rounded-full">

                                        @php
                                            $subtotal += $producto['precio'] * $producto['cantidad'];
                                        @endphp
                                        <form style="margin-left: 20px;" method="POST" action="{{ route('ventas.eliminar') }}">
                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{ $producto_id }}">
                                            <button class="btn-custom pt-2 pl-2 pr-2 pb-2 rounded focus:outline-none" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>

                                @php
                                    $impuestos = $subtotal * 0.16;
                                    $total = $subtotal + $impuestos;
                                @endphp

                                <!-- Subtotal, impuestos y total -->
                                <div class="shadow p-4 rounded">
                                    <p class="text-lg font-semibold text-gray-700">Subtotal: ${{ $subtotal }}</p>
                                    <p class="text-lg font-semibold text-gray-700">IVA (16%): ${{ $impuestos }}</p>
                                    <p class="text-lg font-semibold text-gray-700">Total: ${{ $total }}</p>
                                </div>

                                <!-- Botón para guardar la venta -->
                                <form method="POST" action="{{ route('ventas.store') }}">
                                    @csrf
                                    <!-- Campo para el correo del cliente -->
                                    <input style="margin-top: 10px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="correo_cliente" placeholder="Correo del cliente">
                                    <!-- Campo para el pago -->
                                    <input style="margin-top: 10px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="pago" placeholder="Pago">
                                    <!-- Campos ocultos para subtotal, impuestos y total -->
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    <input type="hidden" name="impuestos" value="{{ $impuestos }}">
                                    <input type="hidden" name="total" value="{{ $total }}">
                                    <button class="btn-custom w-full py-2 px-4 rounded focus:outline-none mt-4" type="submit">Registrar venta</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- FINAL --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
    $(".product-card").click(function(){
        $(this).closest("form").submit();
    });
});

</script>
@endsection
