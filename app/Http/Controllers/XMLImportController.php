<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class XMLImportController extends Controller
{
    public function importXMLCategorias(Request $request)
    {
        // Validar el archivo XML
        $request->validate([
            'xml_file' => 'required|mimes:xml|max:2048'
        ]);

        $xmlData = file_get_contents($request->file('xml_file')->path());

        // Parsear los datos XML y recorrer los registros
        $xml = simplexml_load_string($xmlData);

        foreach ($xml->record as $record) {
            // Extraer datos del XML e insertar en la base de datos
            DB::table('categorias')->insert([
                'nombre_categoria' => (string) $record->nombre,
                'codigo_categoria' => (string) $record->codigo,
                'descripcion_categoria' => (string) $record->descripcion,
                'categoria_creada_por' => (string) $record->creada_por,
                'imagen_categoria' => (string) $record->imagen,
                // Agregar más columnas según sea necesario
            ]);
        }

        return redirect()->back()->with('message', 'Datos XML de Categorías importados exitosamente.');
    }

    public function importXMLSubcategorias(Request $request)
    {
        // Validar el archivo XML
        $request->validate([
            'xml_file' => 'required|mimes:xml|max:2048'
        ]);

        $xmlData = file_get_contents($request->file('xml_file')->path());

        // Parsear los datos XML y recorrer los registros
        $xml = simplexml_load_string($xmlData);

        foreach ($xml->record as $record) {
            // Extraer datos del XML e insertar en la base de datos
            DB::table('subcategorias')->insert([
                'categoria_subcategoria' => (int) $record->categoria_id,
                'codigo_subcategoria' => (string) $record->codigo,
                'nombre_subcategoria' => (string) $record->nombre,
                'descripcion_subcategoria' => (string) $record->descripcion,
                'subcategoria_creada_por' => (string) $record->creada_por,
                'imagen_subcategoria' => (string) $record->imagen,
                // Agregar más columnas según sea necesario
            ]);
        }

        return redirect()->back()->with('message', 'Datos XML de Subcategorías importados exitosamente.');
    }

    public function importXMLProductos(Request $request)
    {
        // Validar el archivo XML
        $request->validate([
            'xml_file' => 'required|mimes:xml|max:2048'
        ]);

        $xmlData = file_get_contents($request->file('xml_file')->path());

        // Parsear los datos XML y recorrer los registros
        $xml = simplexml_load_string($xmlData);

        foreach ($xml->record as $record) {
            // Extraer datos del XML e insertar en la base de datos
            DB::table('productos')->insert([
                'id_categoria_producto' => (int) $record->categoria_id,
                'id_subcategoria_producto' => (int) $record->subcategoria_id,
                'id_marca_producto' => (int) $record->marca_id,
                'nombre_producto' => (string) $record->nombre,
                'descripcion_producto' => (string) $record->descripcion,
                'precio_de_compra' => (float) $record->precio_de_compra,
                'precio_de_venta' => (float) $record->precio_de_venta,
                'unidades_disponibles' => (int) $record->unidades_disponibles,
                'producto_creado_por' => (string) $record->creado_por,
                'imagen_producto' => (string) $record->imagen,
                // Agregar más columnas según sea necesario
            ]);
        }

        return redirect()->back()->with('message', 'Datos XML de Productos importados exitosamente.');
    }

    public function importXMLMarcas(Request $request)
    {
        // Validar el archivo XML
        $request->validate([
            'xml_file' => 'required|mimes:xml|max:2048'
        ]);

        $xmlData = file_get_contents($request->file('xml_file')->path());

        // Parsear los datos XML y recorrer los registros
        $xml = simplexml_load_string($xmlData);

        foreach ($xml->record as $record) {
            // Extraer datos del XML e insertar en la base de datos
            DB::table('marcas')->insert([
                'imagen_marca' => (string) $record->imagen,
                'nombre_marca' => (string) $record->nombre,
                'descripcion_marca' => (string) $record->descripcion,
                'marca_creada_por' => (string) $record->creada_por,
                // Agregar más columnas según sea necesario
            ]);
        }

        return redirect()->back()->with('message', 'Datos XML de Marcas importados exitosamente.');
    }
}
