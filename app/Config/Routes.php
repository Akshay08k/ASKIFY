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
$routes->get('/categories', 'Categories::index');
$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');

// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
//categories manangement by ADMIN
$routes->get('categories', 'Categories::index');
$routes->get('categories/create', 'Categories::create');
$routes->post('categories/store', 'Categories::store');
$routes->get('categories/edit/(:num)', 'Categories::edit/$1');
$routes->post('categories/update/(:num)', 'Categories::update/$1');
$routes->get('categories/delete/(:num)', 'Categories::delete/$1');
// loading contentpolicy
$routes->get('/content-policy', 'ContentController::contentpolicy');
//loading privacy
$routes->get('/privacy', 'ContentController::privacy');
//profile routes
$routes->get('/profile', 'ProfileController::index');
$routes->get('/updatecategory', 'ProfileController::choosecategory');
$routes->get('/updateprofile', 'ProfileController::editProfile');
$routes->post('/updateprofile/save', 'ProfileController::updateProfile');
//loading terms
$routes->get('/terms', 'ContentController::terms');
//loading homepage
$routes->get('/homepage', 'HomepageController::index');
//json page for getting question
$routes->get('/homepage/getQuestions', 'HomepageController::getQuestions');
//Messages Routes
$routes->get('messages', 'MessageController::index');
$routes->get('messages/create', 'MessageController::create');
$routes->post('messages/store', 'MessageController::store');
$routes->get('messages/edit/(:num)', 'MessageController::edit/$1');
$routes->post('messages/update/(:num)', 'MessageController::update/$1');
$routes->get('messages/delete/(:num)', 'MessageController::destroy/$1');
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
