<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Compras PDF</title>
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
    <h1>Tabla de Compras PDF</h1>
    <table>
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Subtotal</th>
                <th>Impuestos</th>
                <th>Costo Total</th>
                <th>Productos Vendidos</th>
                <th>Fecha de Venta</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compras as $compra)
                <tr>
                    <td>{{ $compra->proveedor->nombre_proveedor }}</td>
                    <td>
                        {{-- Si la venta es pendiente muestra success --}}
                        @if ($compra->compra_status == 'pendiente')
                            <span>{{ $compra->compra_status }}</span>
                        @elseif ($compra->compra_status == 'iniciada')
                            <span>{{ $compra->compra_status }}</span>
                        @elseif ($compra->compra_status == 'terminada')
                            <span>{{ $compra->compra_status }}</span>
                        @endif
                    </td>
                    <td>{{ number_format($compra->compra_subtotal, 2) }}</td>
                    <td>{{ number_format($compra->compra_impuestos, 2) }}</td>
                    <td>{{ number_format($compra->compra_total, 2) }}</td>
                    <td>{{ $compra->compra_productos_comprados }}</td>
                    <td>{{ $compra->fecha_compra }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron compras</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
