<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Marcas PDF</title>
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
    <h1>Tabla de Marcas PDF</h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Creada por</th>
            </tr>
        </thead>
        <tbody>
            @forelse($marcas as $marca)
                <tr>
                    <td><img src="{{ public_path('marcas') . '/' . $marca->imagen_marca }}" alt="imagen">
                    </td>
                    <td>{{ $marca->nombre_marca }}</td>
                    <td>{{ $marca->descripcion_marca }}</td>
                    <td>{{ $marca->marca_creada_por }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron marcas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
