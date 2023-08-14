@extends('layouts.user_type.auth')

@section('title', 'Detalle de producto')

@section('content')
    <div class="d-flex justify-content-center container mt-5">
        <div class="card p-3 bg-white"><span class="font-weight-bold">Detalle de producto</span>
            <div class="text-center mt-2 "><img src="{{ asset('productos') . '/' . $producto->imagen_producto }}"
                    alt="{{ $producto->nombre_producto }}" width="300" class="rounded border-radius-lg">
                <div>
                    <h4>{{ $producto->nombre_producto }}</h4>
                    <h6 class="mt-0 text-black-50">{{ $producto->descripcion_producto }} </h6>
                </div>
            </div>
            <div class="stats mt-2">
                <div class="d-flex justify-content-between p-price">
                    <span>Categoria</span><span>{{ $producto->categoria->nombre_categoria }}</span>
                </div>
                <div class="d-flex justify-content-between p-price">
                    <span>Subcategoria</span><span>{{ $producto->subcategoria->nombre_subcategoria }}</span>
                </div>
                <div class="d-flex justify-content-between p-price">
                    <span>Marca</span><span>{{ $producto->marca->nombre_marca }}</span>
                </div>
                <div class="d-flex justify-content-between p-price">
                    <span>Compra</span><span>$ {{ number_format($producto->precio_de_compra, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between p-price">
                    <span>Venta</span><span>$ {{ number_format($producto->precio_de_compra, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between p-price">
                    <span>Unidades</span><span>{{ $producto->unidades_disponibles }}</span>
                </div>

            </div>
            <div class="d-flex justify-content-between mt-2">
                <a href="{{ route('compras') }}" class="btn btn-primary">Comprar</a>
                <a href="{{ route('mostrar-productos') }}" class="btn btn-info">Regresar</a>
            </div>
        </div>
    </div>
@endsection
