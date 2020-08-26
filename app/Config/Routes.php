<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// * Routes Login
$routes->get('/login', 'Home::login');
$routes->post('/login', 'Home::getLogin');
$routes->get('/register', 'Home::register');
$routes->post('/register', 'Home::register');

// * Routes Admin
// ? Routes Dashboard
$routes->get('/logout', 'Dashboard::logout');
$routes->get('/peserta', 'Dashboard::index');
$routes->post('/peserta/ajax', 'Peserta::ajax_list');
$routes->get('/regional', 'Dashboard::regional');
$routes->get('/pembayaran', 'Dashboard::pembayaran');
$routes->get('/statistik', 'Dashboard::statistik');
$routes->get('/pengaturan', 'Dashboard::pengaturan');
$routes->get('/cetak/(:num)', 'Dashboard::cetak/$1');


// ? Routes Peserta
$routes->post('/peserta', 'Peserta::addPeserta');
$routes->put('/peserta', 'Peserta::editPeserta');
$routes->delete('/peserta', 'Peserta::deletePeserta');

// ? Routes Regional
$routes->post('/regional', 'Regional::addRegional');
$routes->put('/regional', 'Regional::editRegional');
$routes->delete('/regional', 'Regional::deleteRegional');

// ? Routes Pengaturan
$routes->put('/pengaturan', 'Dashboard::editPengaturan');
// * Akhir Routes Admin

// * Routes Peserta
$routes->get('/peserta_info', 'Dashboard::pesertaInfo');
$routes->get('/edit_peserta', 'Dashboard::editPesertaInfo');
$routes->get('/peserta_info', 'Dashboard::peserta_info');
$routes->get('/bayar', 'Dashboard::pay');
// * Akhir Routes Peserta

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
