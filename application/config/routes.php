<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'AuthController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Employee Routes
$route['employee'] = 'Frontend/EmployeeController/index';
$route['employee/add'] = 'Frontend/EmployeeController/create';
$route['employee/store'] = 'Frontend/EmployeeController/store';
$route['employee/edit/(:any)'] = 'Frontend/EmployeeController/edit/$1';
$route['employee/update/(:any)'] = 'Frontend/EmployeeController/update/$1';
$route['employee/delete/(:any)'] = 'Frontend/EmployeeController/delete/$1';

// Api route
$route['api/employees'] = 'ApiController/employees';

// Login session route
$route['auth'] = 'AuthController/index';
$route['auth/login'] = 'AuthController/login';
$route['auth/logout'] = 'AuthController/logout';