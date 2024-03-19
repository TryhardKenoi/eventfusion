<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


//Routes - veřejné trasy
$routes->get('/', 'Home::index');

//Routy pro nastaveni webu, filter pouze admin
$routes->group('/settings', ['filter'=>'admin'], function($routes) {
	//pridani nastaveni
	$routes->get('/', 'SiteSettingsController::index');
	
	//ulozeni nastaveni
	$routes->post('/', 'SiteSettingsController::save');
});

//Routes - Trasy s oprávněním přihlášeného uživatele
$routes->group('/', ['filter'=> 'auth'],function($routes) {
	//Routes - Trasy související s eventy
	$routes->get('/event/create','Event::createEventView');
	$routes->post('/event/create', 'Event::createEventPost');
	//$routes->get('/events','Home::getEvents'); //debug - všechny eventy v jsonu
	$routes->get('/event/(:num)','Event::getEventByID/$1');

	$routes->get('event/info/(:num)', 'Event::getEventInfo/$1');

	$routes->get('/event/edit/(:num)', 'Event::editEventView/$1');
	$routes->post('/event/edit/(:num)', 'Event::editEventPost/$1');

	$routes->get('/event/edit/user/remove/(:num)/(:num)', 'Event::removeUserFromEvent/$1/$2');
	$routes->get('/event/edit/group/remove/(:num)/(:num)', 'Event::removeGroupFromEvent/$1/$2');

	$routes->post('/event/delete/(:num)', 'Event::deleteEvent/$1');



	
	//Routes - Trasy související s uživateli
	$routes->get('/profile', 'People::profil/');
	$routes->get('/profile/details/(:num)', 'People::changeDetailsView/$1');
	$routes->post('/profile/details/change/(:num)', 'People::changeDetailsPost/$1');

	$routes->get('/group/create', 'People::createGroupView');
	$routes->post('/group/create', 'People::createGroupPost');	
	$routes->get('/group/(:num)', 'People::getGroupById/$1');
	$routes->get('/group/delete/(:num)', 'People::deleteGroup/$1');
	$routes->post('/group/addUser/(:num)', 'People::addUserToGroup/$1');
    $routes->get('/group/user/remove/(:num)/(:num)', 'People::removeUserFromGroup/$1/$2');

	
	$routes->get('/chat/(:num)', 'Chat::index/$1');
	$routes->get('/chat', 'Chat::fetchChat');
	$routes->post('/chat', 'Chat::add');
});

//Routes -  Trasy s admin oprávněním
$routes->group('admin', ['filter'=> 'admin'],function($routes) {
	//Routes - Trasy související s eventy
	$routes->get('events', 'EventAdmin::getAllEvents');
	$routes->get('event/del/(:num)', 'EventAdmin::deleteEvent/$1');
	$routes->get('event/edit/(:num)', 'EventAdmin::editEventView/$1');
	$routes->post('event/edit/(:num)', 'EventAdmin::editEventSubmit/$1');
	$routes->get('event/edit/user/remove/(:num)/(:num)', 'EventAdmin::removeUserFromEvent/$1/$2');
	$routes->get('event/edit/group/remove/(:num)/(:num)', 'EventAdmin::removeGroupFromEvent/$1/$2');

	//Routes - Trasy související s úživateli
	$routes->get('users', 'PeopleAdmin::getUsers');
	$routes->get('user/delete/(:num)', 'PeopleAdmin::deleteUser/$1');
	$routes->get('user/edit/(:num)', 'PeopleAdmin::editUserView/$1');
	$routes->post('user/edit/(:num)', 'PeopleAdmin::editUserPost/$1');

	$routes->get('register', 'PeopleAdmin::registerUserView');
	$routes->post('register', 'PeopleAdmin::registerUserPost');

	$routes->get('groups', 'PeopleAdmin::getGroups');
	$routes->get('group/create', 'PeopleAdmin::createGroupView');
	$routes->post('group/create', 'PeopleAdmin::createGroupPost');
	$routes->get('group/delete/(:num)', 'PeopleAdmin::deleteGroup/$1');
	$routes->get('group/edit/(:num)', 'PeopleAdmin::editGroup/$1');
	$routes->post('group/user/add/(:num)', 'PeopleAdmin::addUserToGroup/$1');
	$routes->get('group/user/remove/(:num)/(:num)', 'PeopleAdmin::removeUserFromGroup/$1/$2');


});


$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('login', 'Auth::signForm');
	$routes->post('login', 'Auth::login');
	$routes->get('logout', 'Auth::logout');
	$routes->get('register', 'People::registerView');
	$routes->post('register', 'People::registerPost');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
