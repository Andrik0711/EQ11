<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Categorías PDF</title>
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
    <h1>Tabla de Categorías PDF</h1>
    <table>
        <thead>
            <tr>
                <th>Creada por</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->categoria_creada_por }}</td>
                    <td><img src="{{ public_path('categorias') . '/' . $categoria->imagen_categoria }}" alt="imagen">
                    </td>
                    <td>{{ $categoria->nombre_categoria }}</td>
                    <td>{{ $categoria->codigo_categoria }}</td>
                    <td>{{ $categoria->descripcion_categoria }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron categorías</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
