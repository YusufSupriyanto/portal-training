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
$routes->get('/', 'Login::index', ['filter' => 'NAuth']);
$routes->post('/verify', 'Login::validation', ['filter' => 'NAuth']);
$routes->get('/logout', 'Login::logout', ['filter' => 'Auth']);

//Home
$routes->get('/home', 'Home::index', ['filter' => 'Auth']);


//categories


//list training
$routes->get('/list_training', 'Admin\C_ListTraining::index', ['filter' => 'Auth']);
$routes->get('/non_training', 'Admin\C_ListTraining::nonTraining', ['filter' => 'Auth']);
$routes->get('/detail/(:any)', 'Admin\C_ListTraining::detail/$1', ['filter' => 'Auth']);
$routes->post('/addCategory', 'Admin\C_ListTraining::addCategory', ['filter' => 'Auth']);
$routes->post('/import', 'Admin\C_ListTraining::import', ['filter' => 'Auth']);
$routes->post('/import2', 'Admin\C_ListTraining::import2', ['filter' => 'Auth']);
$routes->delete('/delete/(:num)', 'Admin\C_ListTraining::delete/$1', ['filter' => 'Auth']);
$routes->get('/update/(:num)', 'Admin\C_ListTraining::update/$1', ['filter' => 'Auth']);
$routes->post('/edit/(:num)', 'Admin\C_ListTraining::edit/$1', ['filter' => 'Auth']);


//User Admin
$routes->get('/user', 'Admin\C_User::index', ['filter' => 'Auth']);
$routes->post('/addUser', 'Admin\C_User::addUser', ['filter' => 'Auth']);
$routes->delete('/delete/user/(:num)', 'Admin\C_User::delete/$1', ['filter' => 'Auth']);
$routes->get('/update/user/(:num)', 'Admin\C_User::update/$1', ['filter' => 'Auth']);
$routes->post('/edit/user/(:num)', 'Admin\C_User::edit/$1', ['filter' => 'Auth']);


//Form TNA ADMIN
$routes->get('/tna', 'Admin\C_Tna::index', ['filter' => 'Auth']);
$routes->get('/training_monthly', 'Admin\C_Tna::trainingMonthly', ['filter' => 'Auth']);
$routes->post('/accept_admin', 'Admin\C_Tna::accept', ['filter' => 'Auth']);
// $routes->get('/accept_admin/(:num)', 'Admin\C_Tna::accept/$1');
$routes->post('/reject_admin', 'Admin\C_Tna::reject', ['filter' => 'Auth']);
$routes->get('/kadiv_status', 'Admin\C_Tna::kadivStatus', ['filter' => 'Auth']);
$routes->get('/kadiv_accept/(:any)', 'Admin\C_Tna::kadivAccept/$1', ['filter' => 'Auth']);
$routes->post('/accept_adminfixed', 'Admin\C_Tna::acceptAdmin', ['filter' => 'Auth']);
$routes->post('/reject_adminfixed', 'Admin\C_Tna::rejectAdmin', ['filter' => 'Auth']);
$routes->post('/detail_tna', 'Admin\C_Tna::detailTna', ['filter' => 'Auth']);
$routes->post('/detail_reject', 'Admin\C_Tna::detailReject', ['filter' => 'Auth']);
$routes->get('/detail_reject', 'Admin\C_Tna::detailReject', ['filter' => 'Auth']);
$routes->get('/training_ditolak', 'Admin\C_Tna::TrainingDitolak', ['filter' => 'Auth']);
$routes->get('/training_fixed', 'Admin\C_Tna::TrainingFix', ['filter' => 'Auth']);

//schedule training
$routes->get('/schedule_training', 'Admin\C_Schedule::index', ['filter' => 'Auth']);
$routes->get('/schedule_action/(:num)', 'Admin\C_Schedule::askForEvaluation/$1', ['filter' => 'Auth']);

//history
$routes->get('/history', 'Admin\C_History::index', ['filter' => 'Auth']);
$routes->post('/detail_history', 'Admin\C_History::DetailHistory', ['filter' => 'Auth']);
$routes->post('/sertifikat_upload', 'Admin\C_History::SertifikatUpload', ['filter' => 'Auth']);

//USER




//Home User
$routes->get('/home_user', 'User\Home::index', ['filter' => 'Auth']);
$routes->post('/data_home', 'User\Home::DataHome', ['filter' => 'Auth']);
$routes->get('/data_home', 'User\Home::DataHome', ['filter' => 'Auth']);
$routes->get('/jadwal/(:any)', 'User\Home::JadwalHome/$1', ['filter' => 'Auth']);


//Training List
$routes->get('/list_training_user', 'User\ListTraining::index', ['filter' => 'Auth']);
$routes->get('/detail_user/(:any)', 'User\ListTraining::detail/$1', ['filter' => 'Auth']);
$routes->get('/non_training_user', 'User\ListTraining::nonTrainingUser', ['filter' => 'Auth']);

//TNA USER
$routes->get('/data_member', 'User\FormTna::index', ['filter' => 'Auth']);
$routes->post('/form_tna', 'User\FormTna::TnaUser', ['filter' => 'Auth']);
$routes->get('/form_tna', 'User\FormTna::TnaUser', ['filter' => 'Auth']);
$routes->get('/User/FormTna', 'User\FormTna::AjaxTna', ['filter' => 'Auth']);
$routes->post('/User/FormTna', 'User\FormTna::AjaxTna', ['filter' => 'Auth']);
$routes->post('/save_form', 'User\FormTna::TnaForm', ['filter' => 'Auth']);
$routes->post('/tna/send', 'User\FormTna::TnaSend', ['filter' => 'Auth']);
$routes->get('/status_tna', 'User\FormTna::status', ['filter' => 'Auth']);
$routes->get('/request_tna', 'User\FormTna::requestTna', ['filter' => 'Auth']);
$routes->post('/accept_kadiv', 'User\FormTna::acceptKadiv', ['filter' => 'Auth']);
$routes->post('/reject_kadiv', 'User\FormTna::rejectKadiv', ['filter' => 'Auth']);
$routes->post('/accept_bod', 'User\FormTna::acceptBod', ['filter' => 'Auth']);
$routes->post('/reject_bod', 'User\FormTna::rejectBod', ['filter' => 'Auth']);

//Our Schedule User
$routes->get('/member_schedule', 'User\OurSchedule::member', ['filter' => 'Auth']);
$routes->get('/personal_schedule', 'User\OurSchedule::personal', ['filter' => 'Auth']);


//Evaluasi
$routes->get('/evaluasi_reaksi', 'User\Evaluasi::index', ['filter' => 'Auth']);
$routes->get('/form_evaluasi/(:num)', 'User\Evaluasi::EvaluasiForm/$1', ['filter' => 'Auth']);
$routes->post('/send_evaluasi_reaksi', 'User\Evaluasi::SendEvaluasiReaksi', ['filter' => 'Auth']);

//history
$routes->get('/personal_history', 'User\History::index', ['filter' => 'Auth']);
$routes->get('/member_history', 'User\History::memberHistory', ['filter' => 'Auth']);
$routes->post('/download_sertifikat', 'User\History::download', ['filter' => 'Auth']);
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