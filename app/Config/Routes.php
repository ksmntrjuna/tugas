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
$routes->get('/', 'Home::index');
$routes->get('seller/menu', 'Seller\MenuController::index');

#register
$routes->match(['get', 'post'], 'login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::processRegister');

$routes->get('/seller/dashboard', 'AuthController::sellerDashboard');
$routes->get('/buyer/dashboard', 'AuthController::buyerDashboard');

//seller
$routes->get('dashboard/seller', 'Seller\DashboardController::index');
$routes->get('menu', 'Seller\MenuController::index');
$routes->get('/seller/dashboard', 'AuthController::sellerDashboard');
$routes->get('/seller/dashboard', 'AuthController::sellerDashboard');

//menuseller
$routes->get('menu/create', 'Seller\MenuController::create');
$routes->post('menu', 'Seller\MenuController::store');
$routes->post('menu/store', 'Seller\MenuController::store');
$routes->get('menu/edit/(:num)', 'Seller\MenuController::edit/ $1');
$routes->post('menu/(:num)', 'Seller\MenuController::update/$1');
$routes->post('menu/update/(:segment)', 'Seller\MenuController::update/$1');
$routes->get('/menu/delete/(:num)', 'Seller\MenuController::delete/$1');
$routes->get('/dashboard', 'Seller\DashboardController::index');

#buyer
$routes->get('dashboard/buyer', 'Buyer\DashboardController::index');

$routes->get('/buyer/menu', 'Buyer\MenuController::index', ['as' => 'buyer_menu_index']);
$routes->get('/buyer/menu/order/(:num)', 'Buyer\MenuController::order/$1');

$routes->get('dashboard/buyer', 'Seller\DashboardController::index');
$routes->get('menu', 'Buyer\MenuController::index');
$routes->get('/buyer/dashboard', 'AuthController::buyerDashboard');
$routes->get('/buyer/dashboard', 'AuthController::buyerDashboard');

$routes->get('/buyer/menu/order/(:num)', 'Buyer\MenuController::order/$1');
$routes->post('/buyer/menu/storeOrder/(:num)', 'Buyer\MenuController::storeOrder/$1');
$routes->get('/buyer/menu', 'MenuController::index');
$routes->get('/buyer/menu/order/(:num)', 'MenuController::order/$1');
$routes->post('/buyer/menu/storeOrder/(:num)', 'MenuController::storeOrder/$1');
$routes->get('/buyer/menu/payment/(:num)', 'MenuController::showPayment/$1');


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