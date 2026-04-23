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
$routes->get('/dashboard', function () {
    return '<h1>Selamat Datang di Dashboard! Anda berhasil login.</h1> <a href="/logout">Logout di sini</a>';
});
