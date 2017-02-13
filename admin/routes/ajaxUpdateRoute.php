<?php

	// inspect($_POST);

/***************************************************************
*
*						Main Data
*
***************************************************************/

	$id = isset($_REQUEST['routeId']) ? intval($_REQUEST['routeId']) : false;
	$routeNumber = $_REQUEST['routeNumber'];
	$routeType = $_REQUEST['routeType'];
	$routeTitle = $_REQUEST['routeTitle'];
	$routeDescription = $_REQUEST['routeDescription'];
	$routeNotes = $_REQUEST['routeNotes'];

	$db->insert("
		INSERT INTO `routes` 
			(
				`route_id`,
				`route_number`,
				`route_type`,
				`title`,
				`description`,
				`notes`
			)
		VALUES (?, ?, ?, ?, ?, ?)
		ON DUPLICATE KEY UPDATE
			`route_number` = ?,
			`route_type` = ?,
			`title` = ?,
			`description` = ?,
			`notes` = ?
	",
		$id,
		$routeNumber,
		$routeType,
		$routeTitle,
		$routeDescription,
		$routeNotes,

		$routeNumber,
		$routeType,
		$routeTitle,
		$routeDescription,
		$routeNotes
	);

	echo $db->error();
	
	if(!$id) {
		$id=$db->select("select last_insert_id() as id");
		$id=$id[0]['id'];
	}

/***************************************************************
*
*						Route Waypoints
*
***************************************************************/

	$db->delete("DELETE FROM `route_waypoints` 
					WHERE `route_id` = ?", $id);


	if(isset($_REQUEST['routeWaypoints']['direct'])) {
		$wpDirect = $_REQUEST['routeWaypoints']['direct'];
	}
	else {
		$wpDirect = array();
	}

	if(isset($_REQUEST['routeWaypoints']['back'])) {
		$wpBack = $_REQUEST['routeWaypoints']['back'];
	}
	else {
		$wpBack = array();
	}


	if(!empty($wpDirect)) foreach ($wpDirect as $wpid => $order) {

		$db->insert("
			INSERT INTO `route_waypoints` 
				(
					`route_id`,
					`waypoint_id`,
					`waypoint_order`,
					`route_direction`
				)
			VALUES (?, ?, ?, 1)
		",
			$id,
			$wpid,
			$order
		);

		echo $db->error();
	}
	


	if(!empty($wpBack)) foreach ($wpBack as $wpid => $order) {

		$db->insert("
			INSERT INTO `route_waypoints` 
				(
					`route_id`,
					`waypoint_id`,
					`waypoint_order`,
					`route_direction`
				)
			VALUES (?, ?, ?, 2)
		",
			$id,
			$wpid,
			$order
		);

		echo $db->error();
			
	}

/***************************************************************
*
*						Route Trackpoints
*
***************************************************************/

	$db->delete("DELETE FROM `route_trackpoints` 
					WHERE `route_id` = ?", $id);

	if(isset($_REQUEST['routeTrackpoints']['direct'])) {
		$tpDirect = $_REQUEST['routeTrackpoints']['direct'];
	}
	else {
		$tpDirect = array();
	}

	if(isset($_REQUEST['routeTrackpoints']['back'])) {
		$tpBack = $_REQUEST['routeTrackpoints']['back'];
	}
	else {
		$tpBack = array();
	}

	if(!empty($wpDirect)) foreach ($tpDirect as $key=>$trackpoint) {

		$db->insert("
			INSERT INTO `route_trackpoints` 
				(
					`route_id`,
					`direction`,
					`point_order`,
					`point_lat`,
					`point_lng`
				)
			VALUES (?, 1, ?, ?, ?)
		",
			$id,
			// Direction is 1,
			$key+1,
			$trackpoint[0], // X
			$trackpoint[1]	// y
		);
	}

	if(!empty($tpBack)) foreach ($tpBack as $key=>$trackpoint) {

		$db->insert("
			INSERT INTO `route_trackpoints` 
				(
					`route_id`,
					`direction`,
					`point_order`,
					`point_lat`,
					`point_lng`
				)
			VALUES (?, 2, ?, ?, ?)
		",
			$id,
			// Direction is 1,
			$key+1,
			$trackpoint[0], // X
			$trackpoint[1]	// y
		);
	}

	echo json_encode($id);

?>