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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'mainController/index';
$route['dashboard']['get'] = 'mainController/dashboard';
$route['join/(:any)'] = 'mainController/join/$1';



$route['login']['get'] = 'authController/login';
$route['action/login']['post'] = 'authController/loginAction';
$route['register']['get'] = 'authController/register';
$route['action/register']['post'] = 'authController/registerAction';
$route['logout']['get'] = 'authController/logout';

$route['personal']['get'] = 'mainController/personal';
$route['action/edit-personal']['post'] = 'crud/personalController/edit';

$route['arisan-list']['get'] = 'mainController/arisan';
$route['add-arisan']['get'] = 'mainController/addArisan';
$route['edit-arisan']['get'] = 'mainController/editArisan';
$route['action/add-arisan']['post'] = 'crud/arisanController/add';
$route['action/edit-arisan']['post'] = 'crud/arisanController/edit';
$route['action/delete-arisan']['get'] = 'crud/arisanController/delete';


$route['transaction-list']['get'] = 'mainController/transaction';

$route['mainController/(:any)'] = "error404";
$route['authController/(:any)'] = "error404";
$route['crud/(:any)'] = "error404";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
