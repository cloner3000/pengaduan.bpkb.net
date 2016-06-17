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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "front";
$route['404_override'] = '';

// route for mobile app web view
$route['app'] = 'app_main/index';
$route['app/data'] = 'app_main/data';
$route['app/notification'] = 'app_notification/index';
$route['app/notification/data'] = 'app_notification/data';
$route['app/knowledge'] = 'app_knowledge/index';
$route['app/knowledge/data'] = 'app_knowledge/data';
$route['app/auth'] = 'app_auth/index';
$route['app/auth/view_change_password'] = 'app_auth/view_change_password';
$route['app/auth/action_change_password'] = 'app_auth/action_change_password';
$route['app/auth/login'] = 'app_auth/login';
$route['app/auth/logout'] = 'app_auth/logout';
$route['app/replay_ticket'] = 'app_replay_ticket/detail';
$route['app/replay_ticket/replay'] = 'app_replay_ticket/replay';
$route['app/replay_ticket/(:any)'] = 'app_replay_ticket/detail';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
