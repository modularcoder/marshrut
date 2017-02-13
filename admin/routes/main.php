<?php


	$perPage = 10;
	$routes = getRoutes();
	$countRoutes = countRoutes();
	$countPages = ceil($countRoutes/$perPage);

	require admPATH."/templates/header.php";
	require admPATH."/templates/main.php";
	require admPATH."/templates/footer.php";

?>