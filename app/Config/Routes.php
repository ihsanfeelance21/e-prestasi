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
