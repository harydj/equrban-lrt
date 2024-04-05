<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::index');
$routes->post('do_login', 'Home::do_login');
$routes->post('check_account', 'Home::check_account');
$routes->get('admin/dashboard', 'Dashboard_Admin::index');
$routes->post('admin/dashboard', 'Dashboard_Admin::index');
$routes->get('penabung/dashboard', 'Dashboard_Penabung::index');
$routes->post('penabung/dashboard', 'Dashboard_Penabung::index');
$routes->get('admin/formulir_penabung', 'Formulir_Penabung::index');
$routes->get('penabung/formulir_penabung', 'Formulir_Penabung::index');
$routes->get('admin/approval', 'Approval::index');
$routes->get('admin/profile', 'Admin_Profile::index');
$routes->post('logout', 'Home::logout');
$routes->get('logout', 'Home::logout');
$routes->get('admin/user', 'User::index');
$routes->get('Admin/user', 'User::index');
$routes->post('admin/add_user', 'User::add_user');
$routes->post('admin/edit_user', 'User::edit_user');
$routes->get('admin/transaksi_penabung', 'Transaksi_Penabung::index');
$routes->get('admin/bank_api', 'Bank_API::index');
$routes->post('admin/add_penyetoran', 'Formulir_Penabung::add_penyetoran');
$routes->post('admin/add_penarikan', 'Formulir_Penabung::add_penarikan');
$routes->get('admin/approval', 'Approval::index');
$routes->post('admin/approve_setoran', 'Approval::approve_setoran');
$routes->post('admin/reject_setoran', 'Approval::reject_setoran');
$routes->post('admin/proses_tarik', 'Approval::proses_tarik');
$routes->post('admin/reject_penarikan', 'Approval::reject_penarikan');
$routes->post('admin/transfer_dana', 'Approval::transfer_dana');