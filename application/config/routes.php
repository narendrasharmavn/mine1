<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['home'] = "frontend/index";
$route['admin'] = "admin/index";
$route['default_controller'] = 'frontend';

$route['about'] = 'frontend/about';
$route['trustees'] = 'frontend/trustees';


$route['register'] = 'frontend/registerForm';
$route['register-error'] = 'frontend/register';



$route['contact'] = 'frontend/contact';
$route['feedback'] = 'frontend/feedback';
$route['eventsall'] = 'frontend/eventsGridView_ShowAll';

$route['search-results'] = 'frontend/indexsearch';

$route['confirm-booking'] = 'frontend/confirm';
$route['places/(:any)/(:num)'] = 'frontend/placesdetails';
$route['forgot-password'] = 'frontend/forgotForm';

$route['guest-login'] = 'frontend/guestLoginForm';
$route['guestlogin_error'] = 'frontend/submitGuestlogin';

$route['invoice/(:num)'] = 'frontend/invoice/$1';

$route['my-account'] = 'frontend/myAccount';
$route['myaccount-update'] = 'frontend/updateMyAccount';

$route['my-orders'] = 'frontend/myorders';
$route['response'] = 'frontend/response';

$route['login'] = 'frontend/loginForm';
$route['login_error'] = 'frontend/loginCheck';

$route['logout'] = 'frontend/logout';

$route['resorts/(:any)/(:num)'] = 'frontend/showResortDetails/$1/$2';
$route['eventdetails/(:any)/(:num)'] = 'frontend/showEventDetails/$1/$2';

$route['events'] = 'frontend/eventsGridView';
$route['resorts'] = 'frontend/resortsGridView';


$route['placesall'] = "frontend/placegridview";


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
