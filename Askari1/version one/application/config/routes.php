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
$route['default_controller'] = 'admin/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Incidents Management
$route['admin/incidents'] = "Incident/index";
$route['admin/incident/create'] = "Incident/create";
$route['incident/edit'] = "Incident/edit/$1";
$route['admin/incident/store'] = "Incident/store";
$route['incident/show'] = "Incident/show/$1";
$route['incident/update/(:any)'] = "Incident/update/$1";
$route['incident/delete'] = "Incident/delete";

//Leaves Management
$route['admin/leaves'] = "Leave/index";
$route['leave/edit'] = "Leave/edit/$1";
$route['admin/leave/store'] = "Leave/store";
$route['leave/show'] = "Leave/show/$1";
$route['leave/update/(:any)'] = "Leave/update/$1";
$route['leave/delete'] = "Leave/delete";
$route['leave/approve'] = "Leave/approve";
$route['leave/reject'] = "Leave/reject";

// Daily Occurence Book
$route['admin/dobs'] = "Dob/index";
$route['dob/edit'] = "Dob/edit/$1";
$route['admin/dob/store'] = "Dob/store";
$route['dob/show'] = "Dob/show/$1";
$route['dob/update/(:any)'] = "Dob/update/$1";
$route['dob/delete'] = "Dob/delete";
$route['dob/confirm'] = "Dob/confirm";
$route['dob/remarks'] = "Dob/remarks";

//Timesheet
$route['admin/timesheets'] = "Timesheet/index";