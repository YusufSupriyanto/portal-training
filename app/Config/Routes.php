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
$routes->get('/test', 'Test::test1');
$routes->get('/edu', 'Admin\C_User::addIdEducation');




//login
$routes->get('/', 'Login::index', ['filter' => 'NAuth']);
$routes->post('/verify', 'Login::validation', ['filter' => 'NAuth']);
$routes->get('/logout', 'Login::logout', ['filter' => 'Auth']);


//dashboard
$routes->get('/dashboard', 'Admin\C_Dashboard::index', ['filter' => 'Auth']);


//Home
$routes->get('/home', 'Home::index', ['filter' => 'Auth']);


//competency
$routes->get('/list_astra', 'Admin\C_competency::astra', ['filter' => 'Auth']);
$routes->post('/edit_competency_astra', 'Admin\C_competency::EditAstra', ['filter' => 'Auth']);
$routes->delete('/delete/astra/(:num)', 'Admin\C_competency::DeleteAstra/$1', ['filter' => 'Auth']);


$routes->get('/list_technicalA', 'Admin\C_competency::technicalA', ['filter' => 'Auth']);
$routes->get('/list_technicalB', 'Admin\C_competency::technicalB', ['filter' => 'Auth']);
$routes->post('/save_technical', 'Admin\C_competency::SaveTechnical', ['filter' => 'Auth']);
$routes->delete('/delete/technical/(:num)', 'Admin\C_competency::DeleteTechnical/$1', ['filter' => 'Auth']);
$routes->get('/technical_departemen/(:any)/(:any)', 'Admin\C_competency::DetailTechnical/$1/$2', ['filter' => 'Auth']);
$routes->post('/input_technical_file', 'Admin\C_competencyTechnical::InputExcel', ['filter' => 'Auth']);
$routes->get('/list_expert', 'Admin\C_Competency::Expert', ['filter' => 'Auth']);
$routes->post('/expert_file', 'Admin\C_CompetencyExpert::InputExcel', ['filter' => 'Auth']);
$routes->post('/detail_expert_checked', 'Admin\C_CompetencyExpert::CheckedExpert', ['filter' => 'Auth']);
$routes->post('/edit_competency_expert', 'Admin\C_competency::EditExpert', ['filter' => 'Auth']);
$routes->delete('/delete/expert/(:num)', 'Admin\C_competency::DeleteExpert/$1', ['filter' => 'Auth']);

//soft Competency
$routes->get('/list_soft', 'Admin\C_competencySoft::index', ['filter' => 'Auth']);
$routes->post('/soft_file', 'Admin\C_competencySoft::InputExcel', ['filter' => 'Auth']);
$routes->post('/edit_competency_soft', 'Admin\C_competencySoft::EditSoft', ['filter' => 'Auth']);
$routes->delete('/delete/soft/(:num)', 'Admin\C_competencySoft::Delete/$1', ['filter' => 'Auth']);

//Company Competency
$routes->get('/list_company', 'Admin\C_competencyCompany::index', ['filter' => 'Auth']);
$routes->post('/input_company_file', 'Admin\C_competencyCompany::InputExcel', ['filter' => 'Auth']);
$routes->get('/company_division/(:any)', 'Admin\C_CompetencyCompany::DetailCompany/$1', ['filter' => 'Auth']);
$routes->post('/save_company', 'Admin\C_CompetencyCompany::EditCompany', ['filter' => 'Auth']);
$routes->delete('/delete/company/(:num)', 'Admin\C_competencyCompany::Delete/$1', ['filter' => 'Auth']);

//Technical B Competency
$routes->post('/multiple_input_technicalB', 'Admin\C_competencyTechnicalB::InputExcel', ['filter' => 'Auth']);
$routes->get('/technical_departemen/(:any)', 'Admin\C_competencyTechnicalB::DetailTechnical/$1', ['filter' => 'Auth']);
$routes->post('/save_single_technicalB', 'Admin\C_competencyTechnicalB::SaveSingleTechnical', ['filter' => 'Auth']);
$routes->delete('/delete_technicalB/(:any)/(:any)', 'Admin\C_competencyTechnicalB::delete/$1/$2', ['filter' => 'Auth']);
$routes->post('/jabatan_user', 'Admin\C_Competency::getJabatan', ['filter' => 'Auth']);
$routes->post('/edit_technicalB', 'Admin\C_competencyTechnicalB::EditTechnicalB', ['filter' => 'Auth']);

//Copmpetency User
$routes->post('/competency_user', 'Admin\C_User::EditCompetencyUser', ['filter' => 'Auth']);
$routes->post('/change_competency', 'Admin\C_User::ChangeCompetency', ['filter' => 'Auth']);

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
$routes->post('/add_category', 'Admin\C_ListTraining::singleAddCategory', ['filter' => 'Auth']);
$routes->post('/save_training', 'Admin\C_ListTraining::saveSingleTraining', ['filter' => 'Auth']);
$routes->post('/delete_all', 'Admin\C_ListTraining::deleteAllTraining', ['filter' => 'Auth']);
$routes->post('/delete_training', 'Admin\C_ListTraining::deleteTraining', ['filter' => 'Auth']);
$routes->post('/edit_training', 'Admin\C_ListTraining::editTraining', ['filter' => 'Auth']);



//User Admin
$routes->get('/user', 'Admin\C_User::index', ['filter' => 'Auth']);
$routes->post('/addUser', 'Admin\C_User::addUser', ['filter' => 'Auth']);
$routes->delete('/delete/user/(:num)', 'Admin\C_User::delete/$1', ['filter' => 'Auth']);
$routes->post('/update_user', 'Admin\C_User::update', ['filter' => 'Auth']);
$routes->post('/edit_user/(:num)', 'Admin\C_User::edit/$1', ['filter' => 'Auth']);
$routes->post('/save_user', 'Admin\C_User::singleUser', ['filter' => 'Auth']);
$routes->post('/add_education', 'Admin\C_User::AddEducation', ['filter' => 'Auth']);
$routes->post('/add_career', 'Admin\C_User::AddCareer', ['filter' => 'Auth']);
$routes->post('/get_education', 'Admin\C_User::getEducation', ['filter' => 'Auth']);
$routes->post('/edit_user', 'Admin\C_User::EditUser', ['filter' => 'Auth']);
$routes->post('/delete_education', 'Admin\C_User::deleteEducation', ['filter' => 'Auth']);
$routes->post('/delete_career', 'Admin\C_User::deleteCareer', ['filter' => 'Auth']);



//Form TNA ADMIN
$routes->get('/tna', 'Admin\C_Tna::index', ['filter' => 'Auth']);
$routes->get('/training_monthly', 'Admin\C_Tna::trainingMonthly', ['filter' => 'Auth']);
$routes->post('/accept_admin', 'Admin\C_Tna::accept', ['filter' => 'Auth']);
$routes->post('/change_training', 'Admin\C_Tna::change', ['filter' => 'Auth']);
$routes->post('/delete_training_Reject', 'Admin\C_Tna::DeleteTrainingReject', ['filter' => 'Auth']);


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
$routes->get('/training_not_implemented', 'Admin\C_Tna::TrainingNotImplemented', ['filter' => 'Auth']);

//schedule training
$routes->get('/schedule_training', 'Admin\C_Schedule::index', ['filter' => 'Auth']);
$routes->get('/schedule_action/(:num)', 'Admin\C_Schedule::askForEvaluation/$1', ['filter' => 'Auth']);
$routes->post('/schedule_not_implemented', 'Admin\C_Schedule::NotImplemented', ['filter' => 'Auth']);

//history
$routes->get('/history', 'Admin\C_History::index', ['filter' => 'Auth']);
$routes->post('/detail_history', 'Admin\C_History::DetailHistory', ['filter' => 'Auth']);
$routes->post('/sertifikat_upload', 'Admin\C_History::SertifikatUpload', ['filter' => 'Auth']);
$routes->post('/upload_history', 'Admin\C_History::UploadHistory', ['filter' => 'Auth']);


//contac admin
$routes->get('/massage_user', 'Admin\C_Contact::index', ['filter' => 'Auth']);
$routes->post('/delete_contact', 'Admin\C_Contact::delete', ['filter' => 'Auth']);


//Unplanned Training
$routes->get('/tna_unplanned', 'Admin\C_TnaUnplanned::index', ['filter' => 'Auth']);
$routes->get('/status_unplanned', 'Admin\C_TnaUnplanned::kadivStatusUnplanned', ['filter' => 'Auth']);
$routes->get('/unplanned_monthly', 'Admin\C_TnaUnplanned::unplannedMonthly', ['filter' => 'Auth']);
$routes->get('/kadiv_accept_unplanned/(:any)', 'Admin\C_TnaUnplanned::kadivAccept/$1', ['filter' => 'Auth']);

//unplanned Schedule admin
$routes->get('/schedule_unplanned', 'Admin\C_Schedule::unplannedSchedule', ['filter' => 'Auth']);
$routes->get('/schedule_action_unplanned/(:num)', 'Admin\C_Schedule::askForEvaluationUnplanned/$1', ['filter' => 'Auth']);


//unplanned History Admin
$routes->get('/history_unplanned', 'Admin\C_HistoryUnplanned::index', ['filter' => 'Auth']);
$routes->post('/detail_historyunplan_admin', 'Admin\C_HistoryUnplanned::DetailHistory', ['filter' => 'Auth']);
$routes->post('/sertifikat_upload_unplanned', 'Admin\C_HistoryUnplanned::SertifikatUpload', ['filter' => 'Auth']);



//Competency Astra
$routes->post('/astra_file', 'Admin\C_CompetencyAstra::InputExcel', ['filter' => 'Auth']);
$routes->post('/detail_competency_checked', 'Admin\C_CompetencyAstra::CheckedAstra', ['filter' => 'Auth']);


//Budget
$routes->get('/budget', 'Admin\C_Budget::index', ['filter' => 'Auth']);
$routes->post('/save_budget', 'Admin\C_Budget::SaveBudget', ['filter' => 'Auth']);

//Database Department
$routes->get('/database_department', 'Admin\C_Department::index', ['filter' => 'Auth']);
$routes->post('/change_structure', 'Admin\C_Department::ChangeStructure', ['filter' => 'Auth']);
$routes->post('/new_department', 'Admin\C_Department::NewDepartment', ['filter' => 'Auth']);
$routes->post('/update_department', 'Admin\C_Department::UpdateNameDepartment', ['filter' => 'Auth']);

//USER

//profile
$routes->get('/user_profile', 'User\User::index', ['filter' => 'Auth']);
$routes->post('/change_profile', 'User\User::UpdateProfile', ['filter' => 'Auth']);
$routes->post('/competency_profile', 'User\User::CompetencyProfile', ['filter' => 'Auth']);


//Home User
$routes->get('/home_user', 'User\Home::index', ['filter' => 'Auth']);
$routes->post('/data_home', 'User\Home::DataHome', ['filter' => 'Auth']);
$routes->get('/data_home', 'User\Home::DataHome', ['filter' => 'Auth']);
$routes->post('/jadwal', 'User\Home::JadwalHome', ['filter' => 'Auth']);

$routes->post('/jadwal/(:any)', 'User\Home::JadwalHome/$1', ['filter' => 'Auth']);
$routes->post('/modal_member', 'User\Home::MemberModal', ['filter' => 'Auth']);

//Competency User
$routes->get('/member_competency', 'User\Competency::index', ['filter' => 'Auth']);
$routes->post('/detail_competency', 'User\Competency::MemberProfile', ['filter' => 'Auth']);


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
$routes->get('/status_tna_personal', 'User\FormTna::statusPersonal', ['filter' => 'Auth']);
$routes->get('/status_unplanned_personal', 'User\FormTna::statusPersonalUnplanned', ['filter' => 'Auth']);
$routes->get('/request_tna', 'User\FormTna::requestTna', ['filter' => 'Auth']);
$routes->post('/accept_kadiv', 'User\FormTna::acceptKadiv', ['filter' => 'Auth']);
$routes->post('/reject_kadiv', 'User\FormTna::rejectKadiv', ['filter' => 'Auth']);
$routes->post('/accept_bod', 'User\FormTna::acceptBod', ['filter' => 'Auth']);
$routes->post('/reject_bod', 'User\FormTna::rejectBod', ['filter' => 'Auth']);
$routes->post('/delete_training_user', 'User\FormTna::DeleteTrainingUser', ['filter' => 'Auth']);


//Our Schedule User
$routes->get('/member_schedule', 'User\OurSchedule::member', ['filter' => 'Auth']);
$routes->get('/personal_schedule', 'User\OurSchedule::personal', ['filter' => 'Auth']);


//Evaluasi
$routes->get('/evaluasi_reaksi', 'User\Evaluasi::index', ['filter' => 'Auth']);
$routes->get('/form_evaluasi/(:num)', 'User\Evaluasi::EvaluasiForm/$1', ['filter' => 'Auth']);
$routes->post('/send_evaluasi_reaksi', 'User\Evaluasi::SendEvaluasiReaksi', ['filter' => 'Auth']);
$routes->get('/form_evaluasi_selesai/(:num)', 'User\Evaluasi::DetailEvaluasiReaksi/$1', ['filter' => 'Auth']);
$routes->post('/data_evaluasi', 'User\Evaluasi::DataEvaluasi', ['filter' => 'Auth']);
$routes->get('/evaluasi_reaksi_member', 'User\Evaluasi::EvaluasiMember', ['filter' => 'Auth']);
$routes->post('/detail_evaluasi_member', 'User\Evaluasi::detailEvaluasiMember', ['filter' => 'Auth']);
$routes->get('/evaluasi_efektifitas', 'User\EvaluasiEfektifitas::index', ['filter' => 'Auth']);
$routes->get('/form_efektivitas/(:num)', 'User\EvaluasiEfektifitas::formEvaluasi/$1', ['filter' => 'Auth']);
$routes->post('/save_efektivitas', 'User\EvaluasiEfektifitas::saveEfektivitas', ['filter' => 'Auth']);
$routes->get('/detail_efektivitas/(:num)', 'User\EvaluasiEfektifitas::DetailEfektivitas/$1', ['filter' => 'Auth']);
$routes->post('/data_evaluasiEfektivitas', 'User\EvaluasiEfektifitas::DataEvaluasiEfektivitas', ['filter' => 'Auth']);

$routes->get('/send_email', 'User\EvaluasiEfektifitas::sendEmail', ['filter' => 'Auth']);
$routes->cli('/send_email', 'User\EvaluasiEfektifitas::sendEmail');
$routes->get('/evaluasi_efektifitas_personal', 'User\EvaluasiEfektifitas::PersonalEvaluasi');
$routes->get('/evaluasi_efektifitas_unplanned_personal', 'User\EvaluasiEfektivitasUnplanned::PersonalEvaluasiUnplanned');



//history
$routes->get('/personal_history', 'User\History::index', ['filter' => 'Auth']);
$routes->get('/member_history', 'User\History::memberHistory', ['filter' => 'Auth']);
$routes->get('/download_sertifikat/(:any)', 'User\History::download/$1', ['filter' => 'Auth']);
$routes->post('/detail_history_member', 'User\History::detailHistoryMember', ['filter' => 'Auth']);


//unplanned trainining
$routes->get('/data_member_unplanned', 'User\UnplannedTraining::index', ['filter' => 'Auth']);
$routes->post('/form_unplanned', 'User\UnplannedTraining::TnaUserUnplanned', ['filter' => 'Auth']);
$routes->post('/send_unplanned', 'User\FormTna::TnaSend', ['filter' => 'Auth']);
$routes->get('/request_unplanned', 'User\UnplannedTraining::requestUnplanned', ['filter' => 'Auth']);
$routes->get('/status_tna_unplanned', 'User\UnplannedTraining::Status', ['filter' => 'Auth']);
$routes->post('/unplanned', 'User\UnplannedTraining::Unplanned', ['filter' => 'Auth']);
$routes->post('/unplanned_save', 'User\UnplannedTraining::UnplannedSave', ['filter' => 'Auth']);
$routes->post('/data_training', 'User\UnplannedTraining::DataTraining', ['filter' => 'Auth']);

//unplanned schedule
$routes->get('/personal_schedule_unplanned', 'User\OurSchedule::personal', ['filter' => 'Auth']);
$routes->get('/member_schedule_unplanned', 'User\OurSchedule::member', ['filter' => 'Auth']);

//Unplanned Evaluation
$routes->get('/evaluasi_reaksi_unplanned', 'User\EvaluasiUnplanned::index', ['filter' => 'Auth']);
$routes->get('/form_evaluasi_unplanned/(:num)', 'User\EvaluasiUnplanned::EvaluasiForm/$1', ['filter' => 'Auth']);
$routes->get('/form_unplanned_selesai/(:num)', 'User\EvaluasiUnplanned::DetailEvaluasiReaksi/$1', ['filter' => 'Auth']);
$routes->get('/evaluasi_efektifitas_unplanned', 'User\EvaluasiEfektivitasUnplanned::index', ['filter' => 'Auth']);
$routes->get('/form_efektivitas_unplanned/(:num)', 'User\EvaluasiEfektivitasUnplanned::formEvaluasi/$1', ['filter' => 'Auth']);
$routes->post('/save_efektivitas_unplanned', 'User\EvaluasiEfektivitasUnplanned::saveEfektivitas', ['filter' => 'Auth']);
$routes->get('/detail_efektivitas_unplanned/(:num)', 'User\EvaluasiEfektivitasUnplanned::DetailEfektivitas/$1', ['filter' => 'Auth']);
$routes->post('/data_evaluasiEfektivitas', 'User\EvaluasiEfektifitas::DataEvaluasiEfektivitas', ['filter' => 'Auth']);
$routes->get('/evaluasi_reaksi_member_unplanned', 'User\EvaluasiUnplanned::EvaluasiMember', ['filter' => 'Auth']);
$routes->post('/send_evaluasi_reaksi_unplanned', 'User\EvaluasiUnplanned::SendEvaluasiReaksi', ['filter' => 'Auth']);
$routes->post('/detail_evaluasi_member_unplanned', 'User\EvaluasiUnplanned::detailEvaluasiMember', ['filter' => 'Auth']);


//unplanned history
$routes->post('/detail_history_unplanned', 'User\HistoryUnplanned::detailHistoryMember', ['filter' => 'Auth']);

//contac Us
$routes->get('/contac_us', 'User\ContacUs::index', ['filter' => 'Auth']);
$routes->post('/send_massage', 'User\ContacUs::sendContact', ['filter' => 'Auth']);


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