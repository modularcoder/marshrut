<?php

	$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : false;
	$lat = $_REQUEST['lat'];
	$lng = $_REQUEST['lng'];
	$title = $_REQUEST['title'];
	$type = $_REQUEST['type'];

	$db->insert("
		INSERT INTO `waypoints` 
			(	
				`waypoint_id`,
				`waypoint_lat`,
				`waypoint_lng`,
				`waypoint_type`,
				`waypoint_title`
			)
		VALUES (?, ?, ?, ?, ?)
		ON DUPLICATE KEY UPDATE
			`waypoint_lat` = ?,
			`waypoint_lng` = ?,
			`waypoint_type` = ?,
			`waypoint_title` = ?
	",
		$id,
		$lat,
		$lng,
		$type,
		$title,
		$lat,
		$lng,
		$type,
		$title
	);

	if(!$id) {
		$id=$db->select("select last_insert_id() as id");
		$id=$id[0]['id'];
	}

	echo json_encode($id);

?>