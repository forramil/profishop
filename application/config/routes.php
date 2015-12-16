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

$route['default_controller'] = 'main';
$route['404_override'] = 'main';
$route['registration'] = 'main/registration';
$route['remind'] = 'main/remind';
$route['catalog/:num'] = 'user/index/$1';
$route['category/:num'] = 'user/category/$1';
$route['category/:num/:num'] = 'user/category/$1/$2';
$route['add_to_cart'] = 'user/add_to_cart';
$route['change_cart'] = 'user/change_cart';
$route['plus_cart'] = 'user/plus_cart';
$route['minus_cart'] = 'user/minus_cart';
$route['cart'] = 'user/cart';
$route['search'] = 'user/search';
$route['archive'] = 'user/archive';
$route['report'] = 'user/report';
$route['report_html'] = 'user/report_html';
$route['report_archive/:num'] = 'user/report_archive/$1';
$route['download'] = 'user/download';
$route['profile'] = 'user/profile';
$route['logout'] = 'user/logout';

$route['mobile/catalog/:num'] = 'mobile/index/$1';



/* End of file routes.php */
/* Location: ./application/config/routes.php */