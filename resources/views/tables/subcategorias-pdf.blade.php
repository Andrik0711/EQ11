<!DOCTYPE html>
<html>

<head>
    <title>Tabla de SubCategorías PDF</title>
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
    <h1>Tabla de SubCategorías PDF</h1>
    <table>
        <thead>
            <tr>
                <th>Creada por</th>
                <th>Imagen</th>
                <th>ID Categoria Padre</th>
                <th>Nombre</th>
                <th>Descripción</th>

            </tr>
        </thead>
        <tbody>
            @forelse($subcategorias as $subcategoria)
                <tr>
                    <td>{{ $subcategoria->subcategoria_creada_por }}</td>
                    <td><img src="{{ public_path('subcategorias') . '/' . $subcategoria->imagen_subcategoria }}"
                            alt="imagen">
                    </td>
                    <td>{{ $subcategoria->categoria_subcategoria }}</td>
                    <td>{{ $subcategoria->nombre_subcategoria }}</td>
                    <td>{{ $subcategoria->descripcion_subcategoria }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron subcategorías</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
