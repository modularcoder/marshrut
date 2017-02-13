<?php
	
	mb_internal_encoding("UTF-8");
	
	require_once('config.php');
	require_once(htmPATH.'/includes/functions.php');
	require_once(htmPATH.'/includes/models.php');
	
	$validRoutes = 	array(	
							'main',
							'route',
							'about',
							
							'ajaxGetWaypoints',
							'ajaxGetRouteWaypoints',
							'ajaxGetRouteTrackpoints'
					);

	$route = 'main'; // default route

	foreach ($validRoutes as $value) {
		if (isset($_GET[$value])) {
			$route = $value;
		}
	}

	$routeTypes = array(
	    1 => 'երթուղային',
	    2 => 'ավտոբուս',
	    3 => 'տրոլեյբուս'
	);

	$isMakingSearch = false;
	$isHome = false;
	$isRoute = false;
	$isAbout = false;

	$searchFrom = '';
	$searchTo = '';
	
	
	require htmPATH."/routes/{$route}.php";
?>