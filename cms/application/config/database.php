<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	// 'hostname' => '172.17.20.22',
	'hostname' => '202.51.196.157,1444',
	// 'port' => '1433',
	'username' => 'it_yudha',
	'password' => 'yudha@smi202305',
	'database' => 'PB_DEV_Daeng',
	'dbdriver' => 'sqlsrv',
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
	'save_queries' => TRUE
);


$db['euclid'] = array(
        'dsn'   => '',
        'hostname' => '103.166.190.6',
        // 'hostname' => '172.17.20.55',
        'port' => '5432',
        'username' => 'staginguser',
        'password' => 'staginguser#201912',
        'database' => 'postgres',
        'dbdriver' => 'postgre',
        'dbprefix' => '',
        'pconnect' => FALSE,
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
        'save_queries' => TRUE
);

/*
$db['euclid'] = array(
	'dsn'	=> '',
	'hostname' => '172.17.20.197',
	'port' => '5432',
	'username' => 'marzuki',
	'password' => 'IBI@tigas123',
	'database' => 'stagingeuclid',
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci', 
/*        'dbcollat' => 'SQL_Latin1_General_CP1_CI_AS', 
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);*/

$db['rms'] = array(
	'dsn'	=> '',
	// 'hostname' => '172.17.20.84',
	'hostname' => '103.166.190.13,1444',
	// 'port' => '1433',
	'username' => 'it_yudha',
	'password' => 'yudha@smi202305',
	'database' => DB_HO,
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
/*	'dbcollat' => 'SQL_Latin1_General_CP1_CI_AS',*/
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

