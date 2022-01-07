<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;


$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'sahasa.c8rpp7fua2la.us-west-2.rds.amazonaws.com',
	'username' => 'shs_admin',
	'password' => 'fcG$sp6agn&J&K6m',
	'database' => 'mcq_hero_db',
	// 'hostname' => 'localhost',
	// 'username' => 'postgres',
	// 'password' => 'bandarawela',
	// 'database' => 'mcq',
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE,
	'port' => '5432'
);
