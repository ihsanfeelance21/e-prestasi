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

// --- Rute untuk Manajemen Data Siswa ---
$routes->get('/siswa', 'Siswa::index');           // Menampilkan halaman tabel data siswa
$routes->get('/siswa/create', 'Siswa::create');     // Menampilkan halaman form tambah siswa
$routes->post('/siswa/store', 'Siswa::store');      // Memproses data yang dikirim dari form (termasuk upload WebP)
$routes->post('/siswa/update/(:num)', 'Siswa::update/$1');
// Rute ini disiapkan untuk tombol Edit dan Hapus yang ada di tabel (meski fungsinya belum kita buat)
$routes->get('/siswa/edit/(:num)', 'Siswa::edit/$1');
$routes->get('/siswa/delete/(:num)', 'Siswa::delete/$1');
$routes->get('/siswa/detail/(:num)', 'Siswa::detail/$1');
