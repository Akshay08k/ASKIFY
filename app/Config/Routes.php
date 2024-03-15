<?php

namespace Config;

// File: app/Config/Filters.php

$aliases = [
    'ipWhitelist' => \App\Filters\IPWhitelist::class,
];

$globals = [
    'before' => [
        'ipWhitelist' => ['except' => ['public/*']], // Adjust as needed
    ],
    'after' => [],
    'cli' => [],
];

$filters = [];


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*
------------------------------------------
---------USER ROUTES---------------------
------------------------------------------
*/
$routes->get('/', 'Home::index');
$routes->get('/categories', 'Categories::index');
$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Home::logout');

//Reporting Question Routes
$routes->post('report/question/(:num)', 'ReportController::reportQuestion/$1');

// loading contentpolicy
$routes->get('/content-policy', 'ContentController::contentpolicy');
$routes->get('/useofaskify', 'ContentController::useofaskify');

//loading privacy
$routes->get('/privacy', 'ContentController::privacy');

//profile routes
$routes->get('/profile', 'ProfileController::index');
$routes->get('/updatecategory', 'ProfileController::choosecategory');
$routes->get('/profile/Myquestions', 'ProfileController::QueAns');
$routes->post('updatecategory/processCategorySelection', 'ProfileController::processCategorySelection');
$routes->get('/updateprofile', 'ProfileController::editProfile');
$routes->post('/updateprofile/save', 'ProfileController::updateProfile');
$routes->post('/search/liveSearch', 'ProfileController::liveSearch');
$routes->post('/follower/followAction', 'ProfileController::followAction');
$routes->get('/visitprofile/(:any)', 'ProfileController::VisitProfile/$1');


//loading terms
$routes->get('/terms', 'ContentController::terms');

//loading homepage
$routes->get('/homepage', 'HomepageController::index');

$routes->post('/delete-question', 'ProfileController::deleteQuestion');
$routes->post('/delete-answer', 'ProfileController::deleteAnswer');

$routes->post('homepage/search/liveSearch', 'HomepageController::liveSearch');

//json page for getting question
$routes->get('/homepage/getQuestions', 'HomepageController::getQuestions');  //json
$routes->post('/homepage/updateLikeCount/(:num)/(:alpha)', 'HomepageController::updateLikeCount/$1/$2'); //json
$routes->post('/submit_post', 'HomepageController::SubmitPost');
$routes->post('/submit_question', 'HomepageController::SubmitQuestion');
$routes->get('/homepage/checkUserLikeStatus/(:num)', 'HomepageController::checkUserLikeStatus/$1'); //json
//Messages Routes
$routes->get('/messages', 'MessageController::index');
// $routes->get('messages/getUsers', 'MessageController::getUsers'); //json
$routes->get('messages/getMessages/(:num)/(:num)', 'MessageController::getMessages/$1/$2'); //json
$routes->post('messages/sendMessage', 'MessageController::sendMessage');
//notification routes
$routes->get('/notification', 'NotificationController::index');
$routes->post('notification/markAsSeen/(:num)', 'NotificationController::markAsSeen/$1');
//answer routes
$routes->get('/answers', 'AnswerController::index');
$routes->get('/answers/getanswers', 'AnswerController::getAnswers'); //json
$routes->post('answers/store', 'AnswerController::store');
$routes->post('answers/updateAnswerLikeCount/(:num)/(:alpha)', 'AnswerController::updateAnswerLikeCount/$1/$2'); //json
$routes->get('/answers/checkUserLikeStatus/(:num)', 'AnswerController::checkUserLikeStatus/$1'); //json
$routes->post('/answers/submit', 'AnswerController::submitAnswer');
$routes->get("/homepage/getcategories", 'AdminCategoriesController::getcategories'); //json

//
$routes->get('/forgotpassword', 'ForgotPasswordController::index');
$routes->post('/forgot-password', 'ForgotPasswordController::ResetPass');


/*
----------------------------------------
-----------ADMIN ROUTES---------------------
------------------------------------------
*/
$routes->get('/admin', 'AdminController::index');
$routes->post('/admin/login/auth', 'AdminController::auth');

//feedback Routes
$routes->get('/admin/feedbacks', 'AdminHandleIssueController::feedbacks');

//report Routes (Handle Issue Route)
$routes->get('/admin/handle_issues', 'AdminHandleIssueController::Issues');
$routes->post('/admin/resolve_issue/(:num)', 'AdminHandleIssueController::resolveIssue/$1');

//dashboard routes
$routes->get('/admin/dashboard', 'AdminDashboardController::index');

// manage user account 

$routes->get('/admin/getUsers', 'AdminManageUserController::getUsers'); //json
$routes->get('/admin/manage_users', 'AdminManageUserController::index');
$routes->post('/admin/deleteUser/(:num)', 'AdminManageUserController::deleteUser/$1');
$routes->post('/admin/banUser/(:num)', 'AdminManageUserController::banUser/$1');

//Admin Profile
$routes->get('/admin/manage_accounts', 'AdminController::AdminProfile');

$routes->post('admin/updateprofile/save', 'AdminController::updateProfile');

//update categories for admin
$routes->get('admin/manage_categories', 'AdminCategoriesController::index');
$routes->get('categories/create', 'AdminCategoriesController::create');
$routes->post('admincategories/store', 'AdminCategoriesController::store');
$routes->get('categories/edit/(:num)', 'AdminCategoriesController::edit/$1');
$routes->post('categories/update/(:num)', 'AdminCategoriesController::update/$1');
$routes->get('categories/delete/(:num)', 'AdminCategoriesController::delete/$1');

//moderate content
$routes->get('admin/moderate_content', 'AdminContentModController::index');
$routes->post('admin/updateQuestionStatus', 'AdminContentModController::updateQuestionStatus');

//Handle Platform update
$routes->get('admin/handle_updates', 'AdminDashboardController::platform_updates');
$routes->post('/handle_updates/update', 'AdminDashboardController::SendFeedback');



// File: app/Config/Routes.php
$routes->get('messages/getUsers', 'MessageController::getUsers');

// Apply the 'ipWhitelist' filter to the routes serving JSON data
$routes->group('api', ['filter' => 'ipWhitelist'], function ($routes) {

});
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
