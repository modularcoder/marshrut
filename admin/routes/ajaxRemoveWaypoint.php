<?php

	$waypointId = intval($_REQUEST['id']);
	removeWaypoint($waypointId);

	echo json_encode('ok');

?>