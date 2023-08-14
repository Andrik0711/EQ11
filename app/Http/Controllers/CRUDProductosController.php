<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CRUDProductosController extends Controller
{
    // Metodo que manda a la vista de registrar productos
    public function registrarProducto()
    {
        // Le pasamos las categorias
        $categorias = Categoria::all();

        // Le pasamos las subcategorias
        $subcategorias = Subcategoria::all();

        // Le pasamos las marcas
        $marcas = Marca::all();

        return view('forms.productoForm', compact('categorias', 'subcategorias', 'marcas'));
    }

    // Metodo para almacenar la imagen 
    public function ProductoImageStore(Request $request)
    {

        //identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');

        //genera un id unico para cada una de las imagenes que se cargan en el server
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //implementar intervention Image 
        $imagenServidor = Image::make($imagen);

        //agregamos efectps de intervention image: indicamos la medida de cada imagen
        $imagenServidor->fit(1000, 1000);

        //movemos la imagen a un lugar fisico del servidor
        $imagenPath = public_path('productos') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Metodo para mostrar detalles de un producto
    public function mostrarDetalleProducto($id)
    {
        // Buscamos el producto
        $producto = Producto::findOrFail($id);

        // // Le pasamos las categorias
        // $categorias = Categoria::all();

        // // Le pasamos las subcategorias
        // $subcategorias = Subcategoria::all();

        // // Le pasamos las marcas
        // $marcas = Marca::all();

        return view('tickets.productoTicket', compact('producto'));
    }


    // Metodo que muestra todos los productos registrados
    public function mostrarProductos()
    {
        $productos = Producto::all();
        return view('tables.productoTable', compact('productos'));
    }

    // Metodo que registra un producto
    public function ProductoStore(Request $request)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'id_categoria_producto' => 'required',
            'id_subcategoria_producto' => 'required',
            'id_marca_producto' => 'required',
            'nombre_producto' => 'required|unique:productos,nombre_producto',
            'descripcion_producto' => 'required',
            'precio_de_compra' => 'required',
            'precio_de_venta' => 'required',
            'unidades_disponibles' => 'required',
            'producto_creado_por' => 'required',
            'imagen' => 'required'

        ]);

        // Registramos el producto
        Producto::create([
            'id_categoria_producto' => $request->id_categoria_producto,
            'id_subcategoria_producto' => $request->id_subcategoria_producto,
            'id_marca_producto' => $request->id_marca_producto,
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'precio_de_compra' => $request->precio_de_compra,
            'precio_de_venta' => $request->precio_de_venta,
            'unidades_disponibles' => $request->unidades_disponibles,
            'producto_creado_por' => $request->producto_creado_por,
            'imagen_producto' => $request->imagen
        ]);

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('success', 'Producto registrado con exito');
    }

    // Metodo que manda a la vista de editar productos
    public function editarProducto($id)
    {
        // Le pasamos las categorias
        $categorias = Categoria::all();

        // Le pasamos las subcategorias
        $subcategorias = Subcategoria::all();

        // Le pasamos las marcas
        $marcas = Marca::all();

        // Buscamos el producto
        $producto = Producto::findOrFail($id);

        return view('update.productoUpdate', compact('categorias', 'subcategorias', 'producto', 'marcas'));
    }

    // Metodo que edita un producto
    public function ProductoUpdate(Request $request, $id)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'id_categoria_producto' => 'required',
            'id_subcategoria_producto' => 'required',
            'id_marca_producto' => 'required',
            'nombre_producto' => 'required|unique:productos,nombre_producto',
            'descripcion_producto' => 'required',
            'precio_de_compra' => 'required',
            'precio_de_venta' => 'required',
            'unidades_disponibles' => 'required',
            'producto_creado_por' => 'required'
        ]);

        // Buscamos el producto
        $producto = Producto::findOrFail($id);

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta uploads
            File::delete(public_path('productos') . '/' . $producto->imagen_producto);

            // Guardamos el nombre de la nueva imagen en el modelo de la producto
            $producto->imagen_producto = $request->imagen;
        }

        // Actualizamos los campos de la producto
        $producto->id_categoria_producto = $request->input('id_categoria_producto');
        $producto->id_subcategoria_producto = $request->input('id_subcategoria_producto');
        $producto->id_marca_producto = $request->input('id_marca_producto');
        $producto->nombre_producto = $request->input('nombre_producto');
        $producto->descripcion_producto = $request->input('descripcion_producto');
        $producto->precio_de_compra = $request->input('precio_de_compra');
        $producto->precio_de_venta = $request->input('precio_de_venta');
        $producto->unidades_disponibles = $request->input('unidades_disponibles');
        $producto->producto_creado_por = $request->input('producto_creado_por');

        // Guardamos los cambios en la base de datos
        $producto->save();

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('success', 'Producto actualizado con exito');
    }

    // Metodo que elimina un producto
    public function ProductoDestroy($id)
    {
        // Buscamos el producto
        $producto = Producto::findOrFail($id);

        // Eliminamos la imagen de la carpeta [public/productos]
        File::delete(public_path('productos') . '/' . $producto->imagen_producto);
        // Eliminamos el producto
        $producto->delete();

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('success', 'Producto eliminado con exito');
    }

    // Metodo que importa productos
    public function importarProductos()
    {
        return view('forms.importarProductoForm');
    }

    public function getSubcategoriasByCategoria($categoriaId)
    {
        $subcategorias = Subcategoria::where('categoria_subcategoria', $categoriaId)->get();

        return response()->json($subcategorias);
    }
}
