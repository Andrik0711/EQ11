<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Marca;
use App\Models\Cliente;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{

    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function form(Request $request)
    {
        $filtros = $request->all();

        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all();

        $productos = Producto::query();

        if (isset($filtros['categoria_id'])) {
            $productos->where('categoria_id', $filtros['categoria_id']);
        }

        if (isset($filtros['subcategoria_id'])) {
            $productos->where('subcategoria_id', $filtros['subcategoria_id']);
        }

        if (isset($filtros['marca_id'])) {
            $productos->where('marca_id', $filtros['marca_id']);
        }

        if (isset($filtros['nombre'])) {
            $productos->where('nombre', 'LIKE', '%' . $filtros['nombre'] . '%');
        }

        $productos = $productos->get();

        return view('ventas.form', compact('productos', 'categorias', 'subcategorias', 'marcas'));
    }

    public function agregar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $producto_id = $request->get('producto_id');

        if (isset($carrito[$producto_id])) {
            $carrito[$producto_id]['cantidad']++;
        } else {
            $producto = Producto::findOrFail($producto_id);
            $carrito[$producto_id] = [
                'nombre' => $producto->nombre_producto,
                'precio' => $producto->precio_de_venta,
                'cantidad' => 1,
                'imagen' => $producto->imagen_producto,
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito');
    }

    public function eliminar(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $producto_id = $request->get('producto_id');

        if (isset($carrito[$producto_id])) {
            unset($carrito[$producto_id]);
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function store(Request $request)
    {
        // Iniciar una transacción
        DB::beginTransaction();
        try {
            // Obtener el cliente a partir del correo
            $cliente = Cliente::where('correo', $request->correo_cliente)->first();

            if (!$cliente) {
                return back()->with('error', 'No se encontró un cliente con ese correo.');
            }

            $venta = new Venta();

            // Asignar la fecha actual a fecha_venta
            $venta->fecha_venta = Carbon::now();
            $venta->cliente_id = $cliente->id;
            $venta->estatus = "terminada"; // Valor predeterminado
            $venta->pago = "hecho";
            $venta->subtotal = $request->subtotal;
            $venta->descuento = 0; // Valor predeterminado
            $venta->impuestos = $request->impuestos;
            $venta->total = $request->total;
            $venta->pago_monto = $request->pago;
            $venta->vendedor_id = auth()->user()->id;

            // Verificar que el pago sea suficiente
            if ($venta->pago_monto < $venta->total) {
                $venta->estatus = "pendiente"; // Valor predeterminado
                $venta->pago = "pendiente";
            }

            $venta->save();

            // Obtenemos los productos del carrito de la sesión
            $carrito = session()->get('carrito', []);

            // Recorremos cada producto y lo asociamos a la venta
            foreach ($carrito as $producto_id => $producto) {
                $venta->products()->attach($producto_id, ['cantidad' => $producto['cantidad']]);
            }

            // Limpiamos el carrito de la sesión después de guardar la venta
            session()->forget('carrito');

            // Todo salió bien, podemos hacer commit a la transacción
            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente');
        } catch (\Exception $e) {
            // Algo salió mal, debemos hacer rollBack a la transacción
            DB::rollBack();
            // Imprimir o registrar el mensaje de error para depuración
            error_log($e->getMessage());
            return back()->with('error', 'Ocurrió un error al registrar la venta. Error: ' . $e->getMessage());
        }
    }
}
