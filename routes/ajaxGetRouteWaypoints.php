<?php

	$routeId = intval($_REQUEST['route_id']);

	$waypointsUnformated = getWaypointsByRouteId($routeId);

	//inspect($waypointsUnformated);
	
	$waypointsDirect = array();
	$waypointsBack = array();

	foreach ($waypointsUnformated as $waypoint) {
		if($waypoint['route_direction']==1) {
			$waypointsDirect[] = $waypoint['waypoint_id'];
		}
		else {
			$waypointsBack[] = $waypoint['waypoint_id'];
		}
	}

	// inspect($waypoints);

	echo json_encode(array(
		'waypointsDirect' => $waypointsDirect,
		'waypointsBack' => $waypointsBack
	));

?>