<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CRUDProductosController extends Controller
{
    // Metodo que manda a la vista de registrar productos
    public function registrarProducto()
    {
        // Le pasamos las categorias
        $categorias = Categoria::all();

        // Le pasamos las subcategorias
        $subcategorias = Subcategoria::all();

        return view('forms.productoForm', compact('categorias', 'subcategorias'));
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
            'nombre_producto' => 'required',
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
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'precio_de_compra' => $request->precio_de_compra,
            'precio_de_venta' => $request->precio_de_venta,
            'unidades_disponibles' => $request->unidades_disponibles,
            'producto_creado_por' => $request->producto_creado_por,
            'imagen_producto' => $request->imagen
        ]);

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Producto registrado con exito');
    }

    // Metodo que manda a la vista de editar productos
    public function editarProducto($id)
    {
        // Le pasamos las categorias
        $categorias = Categoria::all();

        // Le pasamos las subcategorias
        $subcategorias = Subcategoria::all();

        // Buscamos el producto
        $producto = Producto::findOrFail($id);

        return view('update.productoUpdate', compact('categorias', 'subcategorias', 'producto'));
    }

    // Metodo que edita un producto
    public function ProductoUpdate(Request $request, $id)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'id_categoria_producto' => 'required',
            'id_subcategoria_producto' => 'required',
            'nombre_producto' => 'required',
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
        $producto->nombre_producto = $request->input('nombre_producto');
        $producto->descripcion_producto = $request->input('descripcion_producto');
        $producto->precio_de_compra = $request->input('precio_de_compra');
        $producto->precio_de_venta = $request->input('precio_de_venta');
        $producto->unidades_disponibles = $request->input('unidades_disponibles');
        $producto->producto_creado_por = $request->input('producto_creado_por');

        // Guardamos los cambios en la base de datos
        $producto->save();

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Producto actualizado con exito');
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
        return back()->with('mensaje', 'Producto eliminado con exito');
    }
}
