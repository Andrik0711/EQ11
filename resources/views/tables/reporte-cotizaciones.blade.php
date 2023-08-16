<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Cotizaciones PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 60px;
            max-height: 60px;
        }
    </style>
</head>

<body>
    <h1>Tabla de Cotizaciones PDF</h1>
    <table>
        <thead>
            <tr>
                <th>
                    Producto</th>
                <th>
                    Fecha de cotización</th>
                <th>
                    Referencia</th>
                <th>
                    Cliente</th>
                <th>
                    Estatus</th>
                <th>
                    Total</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cotizaciones as $cotizacion)
                <tr>
                    <td>
                        @foreach ($cotizacion->productos as $producto)
                            <div>
                                <div>
                                    <img src="{{ public_path('productos') . '/' . $producto->imagen_producto }}"
                                        alt="imagen">

                                </div>
                                <div>
                                    <h6>{{ $producto->nombre_producto }}
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <span>{{ $cotizacion->fecha_cotizacion }}</span>
                    </td>
                    <td>
                        <span>{{ $cotizacion->referencia }}</span>
                    </td>
                    <td>
                        <p>
                            {{ $cotizacion->cliente->nombre_cliente }}</p>
                    </td>
                    <td>
                        @if ($cotizacion->status == 'pendiente')
                            <span>{{ $cotizacion->status }}
                            </span>
                        @elseif ($cotizacion->status == 'aprobada')
                            <span>{{ $cotizacion->status }}
                            </span>
                        @elseif ($cotizacion->status == 'inhabilitada')
                            <span>{{ $cotizacion->status }}
                            </span>
                        @elseif ($cotizacion->status == 'iniciada')
                            <span>{{ $cotizacion->status }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <p>
                            $ {{ number_format($cotizacion->total, 2) }}
                        </p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron cotizaciones</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
