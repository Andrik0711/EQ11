<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Productos PDF</title>
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
    <h1>Tabla de Productos PDF</h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>ID Categoria</th>
                <th>ID SubCategoria</th>
                <th>ID Marca</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Unidades Disponibles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td><img src="{{ public_path('productos') . '/' . $producto->imagen_producto }}" alt="imagen">
                    </td>
                    <td>{{ $producto->id_categoria_producto }}</td>
                    <td>{{ $producto->id_subcategoria_producto }}</td>
                    <td>{{ $producto->id_marca_producto }}</td>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->descripcion_producto }}</td>
                    <td>${{ $producto->precio_de_compra }}</td>
                    <td>${{ $producto->precio_de_venta }}</td>
                    <td>{{ $producto->unidades_disponibles }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron productos</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
