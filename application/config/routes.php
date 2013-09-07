<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
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
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "Initial";
$route['admin'] = "admin/initial";
$route['admin/login.html'] = "admin/initial/login";
$route['admin/login'] = "admin/initial/login";
$route['admin/logout.html'] = "admin/initial/logout";
$route['admin/logout'] = "admin/initial/logout";
$route['admin/home.html'] = "admin/initial/home";
$route['admin/home'] = "admin/initial/home";
$route['admin/dashboard.html'] = "admin/initial/dashboard";
$route['admin/dashboard'] = "admin/initial/dashboard";
$route['admin/setlang/(:any).html'] = "admin/initial/setlang/$1/$2";
$route['admin/setlang/(:any)'] = "admin/initial/setlang/$1/$2";

$route['api'] = "api/initial";
$route['api/(:any)'] = "api/initial/$1";
$route['admin/(:any).html'] = "admin/$1";
$route['admin/(:any)'] = "admin/$1";

$route['(:any).html'] = "initial/$1";
$route['(:any)'] = "initial/$1";
$route['scaffolding_trigger'] = "";


/* End of file routes.php */
/* Location: ./system/application/config/routes.php */
