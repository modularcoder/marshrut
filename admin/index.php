<?php
	
	mb_internal_encoding("UTF-8");
	
	require_once('../config.php');
	require_once(htmPATH.'/includes/functions.php');
	require_once(htmPATH.'/includes/models.php');
	
	$validRoutes = 	array(	
							'main',

							'waypoints',
							'ajaxUpdateWaypoint',
							'ajaxRemoveWaypoint',

							'editRoute',
							'ajaxUpdateRoute',
							'ajaxRemoveRoute',
					);

	$route = 'main'; // default route



	foreach ($validRoutes as $value) {
		if (isset($_GET[$value])) {
			$route = $value;
		}
	}
	
	
	require admPATH."/routes/{$route}.php";
?>