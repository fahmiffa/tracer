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
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('setup', 'Dashboard::setup');
$routes->post('login', 'Home::login');
$routes->post('data-alumni', 'Dashboard::data_alumni');
$routes->post('data-loker', 'Dashboard::data_loker');
$routes->post('data-pos', 'Dashboard::data_pos');
$routes->post('data-account', 'Dashboard::data_account');
$routes->post('data-ques', 'Dashboard::data_question');
$routes->post('data-qna/(:any)', 'Dashboard::data_qna/$1');
$routes->post('action', 'Home::action');
$routes->post('reg', 'Home::reg');
$routes->post('act-step1', 'Home::act_step1');
$routes->get('act-step2', 'Home::act_step2');
$routes->post('act-porto', 'Home::act_porto');
$routes->get('act-yet', 'Home::act_yet');
$routes->get('act-done', 'Home::act_done');
$routes->post('act', 'Dashboard::act');

$routes->get('pdf/(:num)', 'Home::pdf/$1');

$routes->get('dashboard', 'Dashboard', ['filter' => 'auth']);
$routes->get('admin', 'Admin', ['filter' => 'auth']);
$routes->get('logout', 'Home::logout');
$routes->get('dash', 'Home::dashboard', ['filter' => 'auth']);
$routes->get('dash/alumni', 'Home::dashboard/$1', ['filter' => 'auth']);
$routes->get('dash/porto', 'Home::dashboard/$1', ['filter' => 'auth']);
$routes->post('upload', 'Home::upload', ['filter' => 'auth']);
$routes->post('remove', 'Home::remove', ['filter' => 'auth']);
$routes->get('registrasi', 'Home::regis');
$routes->get('root', 'Home::root');
$routes->get('alumni', 'Home::alumni');
$routes->get('info', 'Home::info');
$routes->get('info/(:any)', 'Home::info/$1');
$routes->get('loker/(:any)', 'Home::loker/$1');
$routes->get('loker', 'Home::loker');
$routes->get('alumni/step-1', 'Home::alumni_1');
$routes->get('alumni/step-2', 'Home::alumni_2');
$routes->get('step-1', 'Home::step_1');
$routes->get('step-2', 'Home::step_2');

$routes->get('cron/(:any)', 'Home::cron/$1');
// $routes->get('notif/(:any)', 'Home::point/$1');
$routes->post('notif/', 'Home::point');
$routes->post('send/', 'Home::send');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
