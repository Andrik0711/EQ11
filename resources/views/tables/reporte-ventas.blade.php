<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Ventas PDF</title>
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
    <h1>Tabla de Ventas PDF</h1>
    <table>
        <thead>
            <tr>
                <th>
                    Cliente comprador</th>
                <th>
                    Estado</th>
                <th>
                    Pago realizado</th>
                <th>
                    Sub total</th>
                <th>
                    Impuestos</th>
                <th>
                    Costo total</th>
                <th>
                    Productos vendidos</th>
                <th>
                    Fecha de venta</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
                <tr>
                    <td>
                        <span>{{ $venta->cliente->nombre_cliente }}</span>
                    </td>
                    <td>
                        {{-- Si la venta es pendiente muestra success --}}
                        @if ($venta->venta_status == 'terminada')
                            <span>{{ $venta->venta_status }}</span>
                        @elseif ($venta->venta_status == 'devuelta')
                            <span>{{ $venta->venta_status }}</span>
                        @else
                            <span>{{ $venta->venta_status }}</span>
                        @endif

                    </td>
                    <td>
                        <span>$
                            {{ number_format($venta->venta_abono, 2) }}</span>
                    </td>
                    <td>
                        <span>$
                            {{ number_format($venta->venta_subtotal, 2) }}</span>
                    </td>
                    <td>
                        <span>$
                            {{ number_format($venta->venta_impuestos, 2) }}</span>
                    </td>
                    <td>
                        <span>$
                            {{ number_format($venta->venta_total, 2) }}</span>
                    </td>
                    <td>
                        <span>{{ $venta->venta_unidades_vendidas }}</span>
                    </td>
                    <td>
                        <span>{{ $venta->fecha_venta }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron ventas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
