<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\CRUDUsuariosController;
use App\Http\Controllers\CRUDMarcasController;
use App\Http\Controllers\CRUDClientesController;
use App\Http\Controllers\CRUDProductosController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CRUDCategoriasController;
use App\Http\Controllers\CRUDProveedoresController;
use App\Http\Controllers\CRUDSubCategoriasController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\XMLImportController;
use Barryvdh\DomPDF\Facade\PDF;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'index']);
	Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');



	Route::get('profile', function () {
		return view('profile');
	})->name('profile');



	// Route::get('user-management', function () {
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');


	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);

	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');



	// Ruta para mandar a la vista del formulario de usuarios
	Route::get('/registrar-usuario', [CRUDUsuariosController::class, 'registrarUsuario'])->name('registrar-usuario-form');
	// Ruta para registrar usuario
	Route::post('/registrar-usuario', [CRUDUsuariosController::class, 'UsuarioStore'])->name('registrar-usuario-store');
	// Ruta para registrar Imagenes de usuario
	Route::post('/imagenes-usuario', [CRUDUsuariosController::class, 'UsuarioImageStore'])->name('usuario-image-store');
	// Ruta para redireccionar a la vista de editar usuario
	Route::get('/editar-usuario/{id}', [CRUDUsuariosController::class, 'editarUsuario'])->name('editar-usuario');
	// Ruta para editar usuario
	Route::put('/editar-usuario/{id}', [CRUDUsuariosController::class, 'UsuarioUpdate'])->name('editar-usuario-update');
	// Ruta para eliminar usuario
	Route::delete('/eliminar-usuario/{id}', [CRUDUsuariosController::class, 'UsuarioDestroy'])->name('eliminar-usuario');
	// Ruta para mostrar todas las usuarios registradas
	Route::get('/mostrar-usuarios', [CRUDUsuariosController::class, 'mostrarUsuarios'])->name('mostrar-usuarios');



	// Redirecciona a la vista donde se encuentra el formulario de registrar Categoria
	Route::get('/registrar-categoria', [CRUDCategoriasController::class, 'registrarCategoria'])->name('registrar-categoria-form');
	// Ruta para registrar Categoria
	Route::post('/registrar-categoria', [CRUDCategoriasController::class, 'CategoriaStore'])->name('registrar-categoria-store');
	// Ruta para registrar Imagenes de Categoria
	Route::post('/imagenes-categoria', [CRUDCategoriasController::class, 'CategoriaImageStore'])->name('categoria-image-store');
	// Ruta para redireccionar a la vista de editar Categoria
	Route::get('/editar-categoria/{id}', [CRUDCategoriasController::class, 'editarCategoria'])->name('editar-categoria');
	// Ruta para editar Categoria
	Route::put('/editar-categoria/{id}', [CRUDCategoriasController::class, 'CategoriaUpdate'])->name('editar-categoria-update');
	// Ruta para eliminar Categoria
	Route::delete('/eliminar-categoria/{id}', [CRUDCategoriasController::class, 'CategoriaDestroy'])->name('eliminar-categoria');
	// Ruta para mostrar todas las categorias registradas
	Route::get('/mostrar-categorias', [CRUDCategoriasController::class, 'mostrarCategorias'])->name('mostrar-categorias');



	// Redirecciona a la vista donde se encuentra el formulario de registrar SubCategoria
	Route::get('/registrar-subcategoria', [CRUDSubCategoriasController::class, 'registrarSubCategoria'])->name('registrar-subcategoria-form');
	// Ruta para registrar SubCategoria
	Route::post('/registrar-subcategoria', [CRUDSubCategoriasController::class, 'SubCategoriaStore'])->name('registrar-subcategoria-store');
	// Ruta para registrar Imagenes de SubCategoria
	Route::post('/imagenes-subcategoria', [CRUDSubCategoriasController::class, 'SubCategoriaImageStore'])->name('subcategoria-image-store');
	// Ruta para redireccionar a la vista de editar SubCategoria
	Route::get('/editar-subcategoria/{id}', [CRUDSubCategoriasController::class, 'editarSubCategoria'])->name('editar-subcategoria');
	// Ruta para editar SubCategoria
	Route::put('/editar-subcategoria/{id}', [CRUDSubCategoriasController::class, 'SubCategoriaUpdate'])->name('editar-subcategoria-update');
	// Ruta para eliminar SubCategoria
	Route::delete('/eliminar-subcategoria/{id}', [CRUDSubCategoriasController::class, 'SubCategoriaDestroy'])->name('eliminar-subcategoria');
	// Ruta para mostrar todas las subcategorias registradas
	Route::get('/mostrar-subcategorias', [CRUDSubCategoriasController::class, 'mostrarSubCategorias'])->name('mostrar-subcategorias');


	// Redirecciona a la vista donde se encuentra el formulario de registrar Producto
	Route::get('/registrar-producto', [CRUDProductosController::class, 'registrarProducto'])->name('registrar-producto-form');
	// Ruta para registrar Producto
	Route::post('/registrar-producto', [CRUDProductosController::class, 'ProductoStore'])->name('registrar-producto-store');
	// Ruta para obtener las subcategorías de una categoría específica
	Route::get('/api/subcategorias/{categoria}', [CRUDProductosController::class, 'getSubcategoriasByCategoria']);
	// Ruta para registrar Imagenes de Producto
	Route::post('/imagenes-producto', [CRUDProductosController::class, 'ProductoImageStore'])->name('producto-image-store');
	// Ruta para redireccionar a la vista de editar Producto
	Route::get('/editar-producto/{id}', [CRUDProductosController::class, 'editarProducto'])->name('editar-producto');
	// Ruta para editar Producto
	Route::put('/editar-producto/{id}', [CRUDProductosController::class, 'ProductoUpdate'])->name('editar-producto-update');
	// Ruta para eliminar Producto
	Route::delete('/eliminar-producto/{id}', [CRUDProductosController::class, 'ProductoDestroy'])->name('eliminar-producto');
	// Ruta para mostrar todas las productos registradas
	Route::get('/mostrar-productos', [CRUDProductosController::class, 'mostrarProductos'])->name('mostrar-productos');
	// Ruta para importar productos
	Route::get('/importar-productos', [CRUDProductosController::class, 'importarProductos'])->name('importar-productos');
	// Ruta para mostrar detalles de un producto
	Route::get('/mostrar-detalle-producto/{id}', [CRUDProductosController::class, 'mostrarDetalleProducto'])->name('mostrar-detalle-producto');


	// Redirecciona a la vista donde se encuentra el formulario de registrar Marca
	Route::get('/registrar-marca', [CRUDMarcasController::class, 'registrarMarca'])->name('registrar-marca-form');
	// Ruta para registrar Marca
	Route::post('/registrar-marca', [CRUDMarcasController::class, 'MarcaStore'])->name('registrar-marca-store');
	// Ruta para registrar Imagenes de Marca
	Route::post('/imagenes-marca', [CRUDMarcasController::class, 'MarcaImageStore'])->name('marca-image-store');
	// Ruta para redireccionar a la vista de editar Marca
	Route::get('/editar-marca/{id}', [CRUDMarcasController::class, 'editarMarca'])->name('editar-marca');
	// Ruta para editar Marca
	Route::put('/editar-marca/{id}', [CRUDMarcasController::class, 'MarcaUpdate'])->name('editar-marca-update');
	// Ruta para eliminar Marca
	Route::delete('/eliminar-marca/{id}', [CRUDMarcasController::class, 'MarcaDestroy'])->name('eliminar-marca');
	// Ruta para mostrar todas las marcas registradas
	Route::get('/mostrar-marcas', [CRUDMarcasController::class, 'mostrarMarcas'])->name('mostrar-marcas');




	// Ruta para mandar a la vista del formulario de clientes
	Route::get('/registrar-cliente', [CRUDClientesController::class, 'registrarCliente'])->name('registrar-cliente-form');
	// Ruta para registrar cliente
	Route::post('/registrar-cliente', [CRUDClientesController::class, 'ClienteStore'])->name('registrar-cliente-store');
	// Ruta para registrar Imagenes de cliente
	Route::post('/imagenes-cliente', [CRUDClientesController::class, 'ClienteImageStore'])->name('cliente-image-store');
	// Ruta para redireccionar a la vista de editar cliente
	Route::get('/editar-cliente/{id}', [CRUDClientesController::class, 'editarCliente'])->name('editar-cliente');
	// Ruta para editar cliente
	Route::put('/editar-cliente/{id}', [CRUDClientesController::class, 'ClienteUpdate'])->name('editar-cliente-update');
	// Ruta para eliminar cliente
	Route::delete('/eliminar-cliente/{id}', [CRUDClientesController::class, 'ClienteDestroy'])->name('eliminar-cliente');
	// Ruta para mostrar todas las clientes registradas
	Route::get('/mostrar-clientes', [CRUDClientesController::class, 'mostrarClientes'])->name('mostrar-clientes');




	// Ruta para mandar a la vista del formulario de proveedores
	Route::get('/registrar-proveedor', [CRUDProveedoresController::class, 'registrarProveedor'])->name('registrar-proveedor-form');
	// Ruta para registrar proveedor
	Route::post('/registrar-proveedor', [CRUDProveedoresController::class, 'ProveedorStore'])->name('registrar-proveedor-store');
	// Ruta para registrar Imagenes de proveedor
	Route::post('/imagenes-proveedor', [CRUDProveedoresController::class, 'ProveedorImageStore'])->name('proveedor-image-store');
	// Ruta para redireccionar a la vista de editar proveedor
	Route::get('/editar-proveedor/{id}', [CRUDProveedoresController::class, 'editarProveedor'])->name('editar-proveedor');
	// Ruta para editar proveedor
	Route::put('/editar-proveedor/{id}', [CRUDProveedoresController::class, 'ProveedorUpdate'])->name('editar-proveedor-update');
	// Ruta para eliminar proveedor
	Route::delete('/eliminar-proveedor/{id}', [CRUDProveedoresController::class, 'ProveedorDestroy'])->name('eliminar-proveedor');
	// Ruta para mostrar todas las proveedores registradas
	Route::get('/mostrar-proveedores', [CRUDProveedoresController::class, 'mostrarProveedores'])->name('mostrar-proveedores');



	// Ruta para mandar a la tabla de ventas
	Route::get('/mostrar-ventas', [VentasController::class, 'mostrarVentas'])->name('mostrar-ventas');
	// Ruta para mostrar el ticket de la venta
	Route::get('/mostrar-ticket/{id}', [VentasController::class, 'mostrarTicket'])->name('mostrar-ticket');
	// Ruta para eliminar una venta
	Route::delete('/eliminar-venta/{id}', [VentasController::class, 'eliminarVenta'])->name('eliminar-venta');


	// Ruta para ir al punto de venta
	Route::get('/punto-de-venta', [POSController::class, 'index'])->name('punto-de-venta');
	// Ruta para filtrar productos por categoria
	Route::get('/filtrar-productos/{categoriaId}', [POSController::class, 'filtrarProductos'])->name('filtrar-productos');
	// Ruta para mostrar el carrito
	// Route::get('/carrito', [POSController::class, 'mostrarCarrito'])->name('carrito.vista');
	// Ruta para agregar productos al carrito
	Route::post('/agregar-al-carrito', [POSController::class, 'agregarCarrito'])->name('agregar-al-carrito');
	// Ruta para actualizar la cantidad de productos del carrito
	Route::post('/actualizar-cantidad-producto/{productoId}', [POSController::class, 'actualizarCantidadProducto'])->name('actualizar-cantidad-producto');
	// Ruta para almacenar la venta
	Route::post('/almacenar-venta', [POSController::class, 'almacenarVenta'])->name('venta-store');
	// Ruta para eliminar productos del carrito
	Route::delete('/eliminar-del-carrito', [POSController::class, 'eliminarCarrito'])->name('eliminar-del-carrito');


	// Ruta para mostrar la tabla de cotizaciones
	Route::get('/mostrar-cotizaciones', [CotizacionController::class, 'mostrarCotizaciones'])->name('mostrar-cotizaciones');
	// Ruta para mostrar el formulario de cotización
	Route::get('/registrar-cotizacion', [CotizacionController::class, 'crearCotizacion'])->name('registrar-cotizacion-form');
	// Ruta para filtrar productos por categoria de la cotización
	Route::get('/filtrar-productos-cotizacion/{categoriaId}', [CotizacionController::class, 'filtrarProductosCotizacion'])->name('filtrar-productos-cotizacion');
	// Ruta para generar una cotización
	Route::post('/generar-cotizacion', [CotizacionController::class, 'registrarCotizacion'])->name('registrar-cotizacion-store');
	// Ruta para agregar productos a la cotización
	Route::post('/agregar-a-cotizacion', [CotizacionController::class, 'agregarProductoCotizacion'])->name('agregar-cotizacion');
	// Ruta para eliminar productos de la cotización
	Route::delete('/eliminar-de-cotizacion', [CotizacionController::class, 'eliminarProductoCotizacion'])->name('eliminar-producto-cotizacion');
	// Ruta para guardar la cotización
	Route::post('/almacenar-cotizacion', [CotizacionController::class, 'almacenarCotizacion'])->name('cotizacion-store');
	// Ruta para actualizar el estado de la cotización
	Route::put('/actualizar-estado-cotizacion/{id}', [CotizacionController::class, 'actualizarEstadoCotizacion'])->name('actualizar-estado-cotizacion');
	// Ruta para eliminar una cotización
	Route::delete('/eliminar-cotizacion/{id}', [CotizacionController::class, 'eliminarCotizacion'])->name('eliminar-cotizacion');


	// Ruta para ir a la vista de compras de productos
	Route::get('/realizar-compra', [ComprasController::class, 'compraVista'])->name('compras');
	// Ruta para filtrar productos por categoria de la compra en la vista
	Route::get('/filtrar-productos-compra/{categoriaId}', [ComprasController::class, 'filtrarProductos'])->name('filtrar-productos-compra');
	// Ruta para agregar productos a la compra en la tabla
	Route::post('/agregar-compra', [ComprasController::class, 'agregarProducto'])->name('agregar-compra');
	// Ruta para almacenar la compra en la base de datos
	Route::post('/almacenar-compra', [ComprasController::class, 'guardarCompra'])->name('compra-store');
	// Ruta para mostrar la tabla de compras
	Route::get('/mostrar-compras', [ComprasController::class, 'mostrarCompras'])->name('mostrar-compras');
	// Ruta para mostrar el ticket de la compra
	Route::get('/mostrar-ticket-compra/{id}', [ComprasController::class, 'mostrarTicket'])->name('mostrar-ticket-compra');
	// Ruta para eliminar productos de la compra en la tabla
	Route::delete('/eliminar-de-compra', [ComprasController::class, 'eliminarProducto'])->name('eliminar-producto-compra');
	// Ruta para eliminar una compra
	Route::delete('/eliminar-compra/{id}', [ComprasController::class, 'eliminarCompra'])->name('eliminar-compra');



	// Ruta para mostrar la tabla de devoluciones
	Route::get('/mostrar-devoluciones', [DevolucionController::class, 'mostrarDevoluciones'])->name('mostrar-devoluciones');
	// Ruta para guardar una devolucion
	Route::post('/guardar-devolucion/{id}', [DevolucionController::class, 'guardarDevolucion'])->name('guardar-devolucion');
	// Ruta para eliminar una devolucion
	Route::delete('/eliminar-devolucion/{id}', [DevolucionController::class, 'eliminarDevolucion'])->name('eliminar-devolucion');
	// Ruta para actualizar el estado de una devolucion
	Route::put('/actualizar-motivo-devolucion/{id}', [DevolucionController::class, 'actualizarMotivoDevolucion'])->name('actualizar-motivo-devolucion');
	// Ruta para mostrar una devolucion
	Route::get('/mostrar-devolucion/{id}', [DevolucionController::class, 'mostrarDevolucion'])->name('mostrar-devolucion');
	// Ruta para devolver una venta completa
	Route::post('/devolver-venta-completa/{id}', [DevolucionController::class, 'devolverVentaCompleta'])->name('devolver-venta-completa');
	// Ruta para devolver un producto de una venta
	Route::post('/devolver-producto-venta/{producto_id}{venta_id}', [DevolucionController::class, 'devolverProductoVenta'])->name('devolver-producto-venta');






	Route::get('/exportar-pdf-categorias', [PDFController::class, 'exportarPDF'])->name('exportar-pdf-categorias');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');


Route::post('/mostrar-categorias', [CRUDCategoriasController::class, 'mostrarCategorias'])->name('mostrar-categorias');


Route::post('/import-xml-categorias', [XMLImportController::class, 'importXMLCategorias'])->name('import-xml-categorias');
Route::post('/import-xml-subcategorias', [XMLImportController::class, 'importXMLSubcategorias'])->name('import-xml-subcategorias');
Route::post('/import-xml-productos', [XMLImportController::class, 'importXMLProductos'])->name('import-xml-productos');
Route::post('/import-xml-marcas', [XMLImportController::class, 'importXMLMarcas'])->name('import-xml-marcas');

Route::get('/exportar-pdf-categorias', [CRUDCategoriasController::class, 'exportarPDFCategorias'])->name('exportar-categorias.pdf');

Route::get('/exportar-pdf-subcategorias', [CRUDSubCategoriasController::class, 'exportarPDFSubCategorias'])->name('exportar-subcategorias.pdf');

Route::get('/exportar-pdf-marcas', [CRUDMarcasController::class, 'exportarPDFMarcas'])->name('exportar-marcas.pdf');

Route::get('/exportar-pdf-productos', [CRUDProductosController::class, 'exportarPDFProductos'])->name('exportar-productos.pdf');

Route::get('/reporte-pdf-compras', [ComprasController::class, 'reportePDFCompras'])->name('reporte-compras.pdf');

Route::get('/reporte-pdf-ventas', [VentasController::class, 'reportePDFVentas'])->name('reporte-ventas.pdf');
