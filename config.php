<?php

	/*

	define('htmROOT', '/');
	define('htmURL', 'http://marshrut.info');
	define('htmDIR','/public/');
	define('htmPATH',dirname(__FILE__));

	define('admDIR', '/admin/public/');
	define('admURL', htmURL.'/admin');
	define('admPATH', dirname(__FILE__).'/admin/');

	*/

	define('htmROOT', '/path/');
	define('htmURL', 'http://localhost/path');
	define('htmDIR','/path/public/');
	define('htmPATH',dirname(__FILE__));

	define('admDIR', '/path/admin/public/');
	define('admURL', htmURL.'/admin');
	define('admPATH', dirname(__FILE__).'/admin/');

	/******************************************************/

	require_once(htmPATH."/lib/class.simpleDB.php");
	require_once(htmPATH."/lib/class.simpleMysqli.php");

	$settings=array(
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => 'path',
		'port' => 3306,
		'charset' => 'utf8'
	);

	$db = new simpleMysqli($settings);

?>
