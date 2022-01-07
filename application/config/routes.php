<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['category/(:any)'] = 'users/viewQuestions/$1';
$route['category/get/(:any)'] = 'users/viewQuestions_/$1';

$route['admin'] = 'admin';
$route['admin/questions'] = 'admin/home';
$route['admin/addQuestion'] = 'admin/addQuestions';
$route['admin/questions/edit/(:any)'] = 'admin/view_edit_page/$1';
$route['admin/questions/edit/get/(:any)'] = 'admin/getQ_/$1';
$route['admin/questions/update/(:any)'] = 'admin/updateQuestions/$1';
$route['admin/questions/delete/(:any)'] = 'admin/deleteQuestions/$1';

$route['admin/categories'] = 'admin/categories';
$route['admin/addCategory'] = 'admin/addCategories';
$route['admin/categories/edit/(:any)'] = 'admin/editCategories/$1';
$route['admin/categories/update/(:any)'] = 'admin/updateCategories/$1';
$route['admin/categories/delete/(:any)'] = 'admin/deleteCategories/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;