<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//test
$routes->get('/test', 'Test::testAjaxTna');




//login
$routes->get('/', 'Login::index');
$routes->post('/verify', 'Login::validation');
$routes->get('/logout', 'Login::logout');

//Home
$routes->get('/home', 'Home::index');


//categories


//list training
$routes->get('/list_training', 'Admin\C_ListTraining::index');
$routes->get('/non_training', 'Admin\C_ListTraining::nonTraining');
$routes->get('/detail/(:any)', 'Admin\C_ListTraining::detail/$1');
$routes->post('/addCategory', 'Admin\C_ListTraining::addCategory');
$routes->post('/import', 'Admin\C_ListTraining::import');
$routes->post('/import2', 'Admin\C_ListTraining::import2');
$routes->delete('/delete/(:num)', 'Admin\C_ListTraining::delete/$1');
$routes->get('/update/(:num)', 'Admin\C_ListTraining::update/$1');
$routes->post('/edit/(:num)', 'Admin\C_ListTraining::edit/$1');


//User Admin
$routes->get('/user', 'Admin\C_User::index');
$routes->post('/addUser', 'Admin\C_User::addUser');
$routes->delete('/delete/user/(:num)', 'Admin\C_User::delete/$1');
$routes->get('/update/user/(:num)', 'Admin\C_User::update/$1');
$routes->post('/edit/user/(:num)', 'Admin\C_User::edit/$1');


//Form TNA ADMIN
$routes->get('/tna', 'Admin\C_Tna::index');
$routes->post('/accept_admin', 'Admin\C_Tna::accept');
$routes->get('/accept_admin', 'Admin\C_Tna::accept');
$routes->post('/reject_admin', 'Admin\C_Tna::reject');
$routes->get('/kadiv_status', 'Admin\C_Tna::kadivStatus');



//USER




//Home User
$routes->get('/home_user', 'User\Home::index');


//Training List
$routes->get('/list_training_user', 'User\ListTraining::index');
$routes->get('/detail_user/(:any)', 'User\ListTraining::detail/$1');
$routes->get('/non_training_user', 'User\ListTraining::nonTrainingUser');

//TNA USER
$routes->get('/data_member', 'User\FormTna::index');
$routes->get('/form_tna/(:num)', 'User\FormTna::TnaUser/$1');
$routes->get('/User/FormTna', 'User\FormTna::AjaxTna');
$routes->post('/User/FormTna', 'User\FormTna::AjaxTna');
$routes->post('/tna/form/(:num)/(:num)', 'User\FormTna::TnaForm/$1/$2');
$routes->post('/tna/send', 'User\FormTna::TnaSend');
$routes->get('/status_tna', 'User\FormTna::status');
$routes->get('/request_tna', 'User\FormTna::requestTna');
$routes->post('/accept_kadiv', 'User\FormTna::acceptKadiv');
$routes->post('/reject_kadiv', 'User\FormTna::rejectKadiv');



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