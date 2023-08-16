<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Devoluciones PDF</title>
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
    <h1>Tabla de Devoluciones PDF</h1>
    <table>
        <thead>
            <tr>
                <th>
                    Producto</th>
                <th>
                    ID de la venta</th>
                <th>
                    Motivo</th>
                <th>
                    Fecha de devolución</th>
                <th>
                    Cantidad devuelta</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($devoluciones as $devolucion)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{ public_path('productos') . '/' . $devolucion->producto->imagen_producto }}"
                                    alt="imagen">
                            </div>
                            <div>
                                <h6>
                                    {{ $devolucion->producto->nombre_producto }}
                                </h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p>
                            {{ $devolucion->venta_id }}
                        </p>
                    </td>
                    <td>
                        @if ($devolucion->motivo_devolucion === 'Sin motivo')
                            <span>{{ $devolucion->motivo_devolucion }}</span>
                        @else
                            <span>{{ $devolucion->motivo_devolucion }}</span>
                        @endif
                    </td>
                    <td>
                        <p>
                            {{ $devolucion->fecha_devolucion }}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{ $devolucion->cantidad_devuelta }}
                        </p>
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="7">No se encontraron devoluciones</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
