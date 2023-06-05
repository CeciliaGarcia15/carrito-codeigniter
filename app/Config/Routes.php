<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
$routes->get('/', 'Home::index',['as' => 'principal']);
$routes->get('/quienes_somos', 'Home::quienes_somosIndex' , ['as' => 'quienes_somos']);
$routes->get('/contacto', 'Home::contactoIndex', ['as' => 'contacto']);
$routes->post('/contacto/email', 'Home::contactoStore', ['as' => 'contacto_store']);
$routes->get('/comercializacion', 'Home::comercializacionIndex', ['as' => 'comercializacion']);
$routes->get('/terminos', 'Home::terminosIndex', ['as' => 'terminos']);
//USUARIO
$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/login', 'Usuarios::login');
$routes->get('/logout', 'Usuarios::logout');
$routes->post('/login2', 'Usuarios::login2');
$routes->get('/register', 'Usuarios::register');
$routes->post('/usuarios/store', 'Usuarios::store');

//PRODUCTOS
$routes->get('/productos', 'Products::index');
$routes->get('/productos/nuevo', 'Products::create');
$routes->post('/productos/store', 'Products::store');
$routes->get('/productos/editar/(:num)', 'Products::edit/$1');
$routes->post('/productos/update', 'Products::update');
$routes->get('/productos/delete/(:num)', 'Products::destroy/$1');
$routes->post('/productos/search', 'Products::search');
$routes->get('/productos/inactivos', 'Products::inactivos');
//categoriaS
$routes->get('/categorias', 'categorias::index');
$routes->get('/categorias/nuevo', 'categorias::create');
$routes->post('/categorias/store', 'categorias::store');
$routes->get('/categorias/editar/(:num)', 'categorias::edit/$1');
$routes->post('/categorias/update', 'categorias::update');
$routes->get('/categorias/delete/(:num)', 'categorias::destroy/$1');
$routes->post('/categorias/search', 'categorias::search');
$routes->get('/categorias/inactivos', 'categorias::inactivos');
//series
$routes->get('/series', 'series::index');
$routes->get('/series/nuevo', 'series::create');
$routes->post('/series/store', 'series::store');
$routes->get('/series/editar/(:num)', 'series::edit/$1');
$routes->post('/series/update', 'series::update');
$routes->get('/series/delete/(:num)', 'series::destroy/$1');
$routes->post('/series/search', 'series::search');
$routes->get('/series/inactivos', 'series::inactivos');
//CARRITO
$routes->get('carrito', 'Carts::index');
$routes->get('carrito/agregar/(:num)', 'Carts::agregarCarrito/$1');
$routes->get('carrito/eliminar/(:num)', 'Carts::eliminarCarrito/$1');
$routes->get('carrito/limpiar', 'Carts::limpiarCarrito');

//factura
$routes->get('factura/generar', 'fs::limpiarCarrito');



