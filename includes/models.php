<?php
	$getRoutes_defaults = array(
		'num_posts' 	=> 10,			// Number of posts to query
		
		'type'			=> false,

		'paged'			=> (isset($_GET['paged'])) ? intval($_GET['paged']) : 1,		// Number of page, from which began to query (used for pagination)
		
		'order_by'		=> 'ABS(`route_number`)',	// Default Order by Date Published
	);

	function getRoutes($args = array()) {
		global $getRoutes_defaults, $db;
        $args = array_merge($getRoutes_defaults, $args);

		extract($args);

		$query_from = ($paged-1) * $num_posts;
		$res = $db->select("SELECT *
								FROM `routes` t1
								ORDER BY $order_by
								LIMIT ?,?
								", $query_from, $num_posts);

		return $res;
	}

	function countRoutes($args = array()) {
		global $getRoutes_defaults, $db;
        $args = array_merge($getRoutes_defaults, $args);
		extract($args);

		$res = $db->select("SELECT count(*) count
								FROM `routes`");

		return $res[0]['count'];
	}

	function getRouteById($id) {
		global $db;

		$id = intval($id);

		$res = $db->select("SELECT * 
							FROM `routes`
							WHERE route_id = ?", $id);
		
		if($db->queryInfo['num_rows'] > 0){
			return $res[0];
		}
		else {
			return false;
		}
	}

	function getRoutesByType($type) {
		global $db;

		$type = intval($type);

		$routes = 	$db->select("SELECT `route_id`, `route_number`, `notes`
									FROM `routes`
									WHERE `route_type` = ?
									ORDER BY convert(`route_number`, decimal) ", $type);

		return $routes;
	}

	function getWaypoints() {
		global $db;

		$res = 	$db->select("SELECT *
								FROM `waypoints`");

		if($db->queryInfo['num_rows'] > 0){
			return $res;
		}
		else {
			return false;
		}
	}

	function getWaypointsByRouteId($routeId) {
		global $db;

		$routeId = intval($routeId);

		$res= $db->select("SELECT 	*
							FROM `route_waypoints` as `route_waypoints`
								JOIN `waypoints` as `waypoints`
								ON `waypoints`.`waypoint_id` =  `route_waypoints`.`waypoint_id`
							WHERE `route_waypoints`.`route_id` = ?
							ORDER BY `route_waypoints`.`waypoint_order` ASC
		", $routeId);

		if($db->queryInfo['num_rows'] > 0){
			// return $res;

			$waypointsDirect = array();
			$waypointsBack = array();

			foreach ($res as $waypoint) {
				if($waypoint['route_direction']==1) {
					$waypointsDirect[] = $waypoint;
				}
				else {
					$waypointsBack[] = $waypoint;
				}
			}

			return array(
				'waypointsDirect' => $waypointsDirect,
				'waypointsBack' => $waypointsBack
			);
		}
		else {
			return false;
		}

	}

	function getTrackpointsByRouteId($routeId) {
		global $db;

		$routeId = intval($routeId);

		$res= $db->select("SELECT 	*
							FROM `route_trackpoints` 
							WHERE `route_id` = ?
							ORDER BY `point_order` ASC
		", $routeId);

		if($db->queryInfo['num_rows'] > 0){
			return $res;
		}
		else {
			return false;
		}

	}

	function getBusStops($routeId) {
		global $db;

		$routeId = intval($routeId);

		$res= $db->select("SELECT * 
							FROM `route_waypoints` as `route_waypoints`
								JOIN `waypoints` as `waypoints`
								ON `waypoints`.`waypoint_id` =  `route_waypoints`.`waypoint_id`
							WHERE `route_waypoints`.`route_id` = ?
								AND `waypoints`.`waypoint_type` = 1
		", $routeId);

		if($db->queryInfo['num_rows'] > 0){
			return $res;
		}
		else {
			return false;
		}
	}

	function removeWaypoint($waypointId) {
		global $db;

		$waypointId = intval($waypointId);

		$res = $db->delete("DELETE FROM `waypoints`
									WHERE `waypoint_id` = ?", $waypointId);


		return true;
	}

?>