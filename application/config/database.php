<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	// 'hostname' => '172.17.20.84',
	'hostname' => '202.51.196.157,1444',
	// 'port' => '1433',
	'username' => 'it_yudha',
	'password' => 'yudha@smi202305',
	'database' => 'PB_DEV_Daeng',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	// 'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
