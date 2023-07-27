<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CRUDMarcasController;
use App\Http\Controllers\CRUDClientesController;
use App\Http\Controllers\CRUDProductosController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CRUDCategoriasController;
use App\Http\Controllers\CRUDProveedoresController;
use App\Http\Controllers\CRUDSubCategoriasController;

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

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');



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
	// Ruta para redireccionar a la vista de editar proveedor
	Route::get('/editar-proveedor/{id}', [CRUDProveedoresController::class, 'editarProveedor'])->name('editar-proveedor');
	// Ruta para editar proveedor
	Route::put('/editar-proveedor/{id}', [CRUDProveedoresController::class, 'ProveedorUpdate'])->name('editar-proveedor-update');
	// Ruta para eliminar proveedor
	Route::delete('/eliminar-proveedor/{id}', [CRUDProveedoresController::class, 'ProveedorDestroy'])->name('eliminar-proveedor');
	// Ruta para mostrar todas las proveedores registradas
	Route::get('/mostrar-proveedores', [CRUDProveedoresController::class, 'mostrarProveedores'])->name('mostrar-proveedores');
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
