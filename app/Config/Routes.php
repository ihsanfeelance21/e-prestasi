<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Rute Autentikasi
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::process');
$routes->get('/logout', 'AuthController::logout');

// Rute Dashboard (sementara kita buat pakai Closure agar cepat untuk testing)
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/prestasi', 'PrestasiController::index');
$routes->get('/prestasi/create', 'PrestasiController::create');
$routes->post('/prestasi/store', 'PrestasiController::store');
$routes->get('/prestasi/delete/(:num)', 'PrestasiController::delete/$1');
$routes->get('/prestasi/edit/(:num)', 'PrestasiController::edit/$1');
$routes->post('/prestasi/update/(:num)', 'PrestasiController::update/$1');
// Rute untuk validasi admin
$routes->get('/prestasi/validate/(:num)/(:any)', 'PrestasiController::validateStatus/$1/$2');
