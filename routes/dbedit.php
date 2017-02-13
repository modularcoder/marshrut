<?php

	//$routeId = intval($_GET['route']);

	//$route = getRouteById($routeId);

	//inspect($route);

	$routes = getRoutes();

	foreach ($routes as $route) {
		$description = $route['description'];
		$title = $route['title'];

		$description = str_replace($title.'<br>', '', $description);

		// echo $description;

		// $db->update("UPDATE `routes` 
		// 				SET `description`= ?
		// 				WHERE `route_id` = ?", $description, $route['route_id']);
	}



?>