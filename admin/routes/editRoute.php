<?php
	
	$routeId = intval($_REQUEST['id']);

	$route = getRouteById($routeId);

	// inspect($route);

	// inspect($route);
	
	extract($route);


	$waypoints = getWaypointsByRouteId($routeId);

	$waypointsBack = array();
	$waypointsDirect = array();

	if($waypoints) {
		extract($waypoints);
	}

	require admPATH."/templates/header.php";
	require admPATH."/templates/routeEditor.php";
	require admPATH."/templates/footer.php";

?>