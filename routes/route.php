<?php

	$isRoute = true;

	$routeId = intval($_GET['route']);
	$route = getRouteById($routeId);

	if(!$route){
		header( "Location: ".'404');
	}

	extract($route);

	require htmPATH."/templates/header.php";
	require htmPATH."/templates/single.php";
	require htmPATH."/templates/footer.php";





?>