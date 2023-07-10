<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

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
            'producto_creado_por' => 'required'
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
            'producto_creado_por' => $request->producto_creado_por
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

        // Actualizamos el producto
        $producto->update([
            'id_categoria_producto' => $request->id_categoria_producto,
            'id_subcategoria_producto' => $request->id_subcategoria_producto,
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'precio_de_compra' => $request->precio_de_compra,
            'precio_de_venta' => $request->precio_de_venta,
            'unidades_disponibles' => $request->unidades_disponibles,
            'producto_creado_por' => $request->producto_creado_por
        ]);

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Producto actualizado con exito');
    }

    // Metodo que elimina un producto
    public function ProductoDestroy($id)
    {
        // Buscamos el producto
        $producto = Producto::findOrFail($id);

        // Eliminamos el producto
        $producto->delete();

        // Redireccionamos a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Producto eliminado con exito');
    }
}
