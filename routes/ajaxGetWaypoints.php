<?php

	$waypointsUnformated = getWaypoints();
	$waypoints = array();

	foreach ($waypointsUnformated as $waypoint) {
		$waypoints[] = array(
			'id' => $waypoint['waypoint_id'],
			'lat' => $waypoint['waypoint_lat'],
			'lng' => $waypoint['waypoint_lng'],
			'title' => $waypoint['waypoint_title'],
			'type' => $waypoint['waypoint_type'],
		);
	}

	// inspect($waypoints);

	echo json_encode($waypoints);

?>