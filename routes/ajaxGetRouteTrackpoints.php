<?php

	$routeId = intval($_REQUEST['route_id']);

	$trackpoints = getTrackpointsByRouteId($routeId);

	$trackpointsDirect = array();
	$trackpointsBack = array();

	if($trackpoints) foreach ($trackpoints as $trackpoint) {
		if($trackpoint['direction']==1) {
			$trackpointsDirect[] = array(
				$trackpoint['point_lat'],
				$trackpoint['point_lng']
			);
		}
		else {
			$trackpointsBack[] = array(
				$trackpoint['point_lat'],
				$trackpoint['point_lng']
			);;
		}
	}

	echo json_encode(array(
		'direct' => $trackpointsDirect,
		'back' => $trackpointsBack
	));

?>