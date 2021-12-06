<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['admin'] = 'admin';
$route['admin/questions'] = 'admin/home';
$route['admin/addQuestion'] = 'admin/addQuestions';
$route['admin/categories'] = 'admin/categories';
$route['admin/addCategory'] = 'admin/addCategories';
$route['admin/categories/edit/(:any)'] = 'admin/editCategories/$1';
$route['admin/categories/update/(:any)'] = 'admin/updateCategories/$1';
$route['admin/categories/delete/(:any)'] = 'admin/deleteCategories/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['ajax'] = 'admin/ajax';