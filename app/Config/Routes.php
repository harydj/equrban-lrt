<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('do_login', 'Home::do_login');
$routes->post('check_account', 'Home::check_account');
$routes->get('dashboard/admin', 'Dashboard::admin');
$routes->get('dashboard/penabung', 'Dashboard::penabung');
$routes->post('logout', 'Home::logout');
$routes->get('logout', 'Home::logout');
$routes->get('admin/user', 'User::index');
$routes->get('Admin/user', 'User::index');
$routes->post('admin/add_user', 'User::add_user');
$routes->post('admin/edit_user', 'User::edit_user');