<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class POSController extends Controller
{
    //Motodo que muestra la vista de productos
    public function index()
    {
        // pasamos todas las categorias a la vista
        $categorias = Categoria::all();

        // Obtenemos todos los productos
        $todosLosProductos = Producto::all();

        // Pasamos todos los clientes a la vista
        $clientes = Cliente::all();
        return view('pos.pos', compact('categorias', 'todosLosProductos', 'clientes'));
    }

    // Metodo para hacer el filtrado de productos por categoria
    public function filtrarProductos($categoriaId)
    {
        // dd($categoriaId);
        // Obtener todas las categorias
        $categorias = Categoria::all();

        // Obtener los productos de la categoría seleccionada
        $productosfiltrados = Producto::where('id_categoria_producto', $categoriaId)->get();

        // Pasar los productosfiltrados filtrados a la vista
        return view('pos.pos', compact('productosfiltrados', 'categorias'));
    }

    public function agregarCarrito(Request $request)
    {
        // dd($request->all()); // Recibe solo el id del producto

        $carrito = session()->get('carrito', []);
        $producto_id = $request->get('producto_id');
        $accion = $request->get('agregar');

        // dd($accion);


        // Validamos si se recibe un add

        // Si se recibe un add, se agrega un producto al carrito
        if ($accion === 'add') {

            // dd($carrito[$producto_id]);

            if (isset($carrito[$producto_id])) {
                $carrito[$producto_id]['cantidad']++;
            } else {
                $producto = Producto::findOrFail($producto_id);

                // dd($carrito[$producto_id] = [
                //     'nombre' => $producto->nombre_producto,
                //     'precio' => $producto->precio_de_venta,
                //     'cantidad' => 1,
                //     'imagen' => $producto->imagen_producto,
                // ]);

                $carrito[$producto_id] = [
                    'nombre' => $producto->nombre_producto,
                    'precio' => $producto->precio_de_venta,
                    'cantidad' => 1,
                    'imagen' => $producto->imagen_producto,
                ];
            }
            session()->put('carrito', $carrito);
            return back()->with('mensaje', 'Producto agregado al carrito');
        } // Si se recibe un less, se elimina un producto del carrito 
        elseif ($accion === 'less') {
            if (isset($carrito[$producto_id])) {

                // dd($carrito[$producto_id]);

                // Validamos que la cantidad no sea menor a 1
                if ($carrito[$producto_id]['cantidad'] > 1) {
                    $carrito[$producto_id]['cantidad']--;
                    session()->put('carrito', $carrito);
                    return back()->with('mensaje', 'Producto disminuido del carrito');
                }
            }
        }
    }

    // Eliminar el producto del carrito
    public function eliminarCarrito(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $producto_id = $request->get('producto_id');

        if (isset($carrito[$producto_id])) {
            unset($carrito[$producto_id]);
        }

        session()->put('carrito', $carrito);
        return back()->with('mensaje', 'Producto eliminado del carrito');
    }

    // Almacenar la venta en la base de datos
    public function almacenarVenta(Request $request)
    {
        // Obtener los datos de la solicitud
        $total = $request->input('total');
        $subtotal = $request->input('subtotal');
        $impuestos = $request->input('impuestos');
        $unidades_vendidas = $request->input('unidades_vendidas');
        $abono = $request->input('abono');
        $id_cliente_venta = $request->input('cliente_venta');

        // Validar que el carrito no esté vacío
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return back()->with('mensaje', 'No hay productos en el carrito');
        }

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener el cliente a partir del id
            $cliente = Cliente::findOrFail($id_cliente_venta);

            // Crear la venta
            $venta = new Venta();
            $venta->fecha_venta = Carbon::now();
            $venta->cliente_id = $cliente->id;

            // Condicionar el estatus de la venta
            $venta->venta_status = ($abono < $total) ? "pendiente" : "terminada";

            // Almacenar los demás datos
            $venta->venta_abono = $abono;
            $venta->venta_subtotal = $subtotal;
            $venta->venta_impuestos = $impuestos;
            $venta->venta_total = $total;
            $venta->venta_unidades_vendidas = $unidades_vendidas;

            // Guardar la venta
            $venta->save();

            // Obtener los productos vendidos del carrito
            $productosVendidos = [];
            foreach ($carrito as $producto_id => $producto) {
                $productosVendidos[$producto_id] = [
                    'cantidad_vendida' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => $producto['cantidad'] * $producto['precio'],
                ];
            }

            // Asociar los productos vendidos a la venta
            $venta->productos()->attach($productosVendidos);

            // Limpiar el carrito de la sesión después de guardar la venta
            session()->forget('carrito');

            DB::commit();

            return back()->with('Listo', 'Venta realizada con éxito');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('mensaje', 'Ha ocurrido un error al procesar la venta: ' . $e->getMessage());
        }
    }
}
