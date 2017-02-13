<?php
	
	$perPage = 10;

	$activePage = (isset($_GET['paged'])) ? intval($_GET['paged']) : 1;
	$queryFrom = $perPage * ($activePage-1);
	$queryTo = $perPage;

	$searchFrom = isset($_GET['searchFrom']) ? trim($_GET['searchFrom'])  : '';
	$searchTo = isset($_GET['searchTo']) ? trim($_GET['searchTo'])  : '';

	// If any of search from or search to is more than or equal 2 chars
	// Make search
	if( mb_strlen($searchFrom) >= 2 || mb_strlen($searchTo) >= 2 )  {

		$isMakingSearch = true;

		$searchClauses = generateSearchClauses($searchFrom, $searchTo);
		$SEARCH_FROM_CLAUSE = $searchClauses['from'];
		$SEARCH_TO_CLAUSE = $searchClauses['to'];

		

		$routes = 	$db->select("SELECT * 
									FROM `routes`
									WHERE $SEARCH_FROM_CLAUSE $SEARCH_TO_CLAUSE
									LIMIT ?, ?
					", $queryFrom, $queryTo);
	  /*$routes = 	$db->select("SELECT * 
									FROM `routes`
									WHERE $SEARCH_FROM_CLAUSE $SEARCH_TO_CLAUSE
									ORDER BY ABS(`route_number`)
									LIMIT ?, ?
					", $queryFrom, $queryTo);*/

		$countRoutes = 	$db->selectCell("SELECT count(*) as `count`
										FROM `routes`
										WHERE $SEARCH_FROM_CLAUSE $SEARCH_TO_CLAUSE
						");

		$countPages = ceil($countRoutes/$perPage);
		$baseUrl = htmURL."?searchFrom=$searchFrom&searchTo=$searchTo";
		

	}
	// Else display all routes
	else {

		$isHome = true;

		$routes = 	$db->select("SELECT * 
									FROM `routes`
									LIMIT ?, ?
					", $queryFrom, $queryTo);
	  /*$routes = 	$db->select("SELECT * 
									FROM `routes`
									ORDER BY ABS(`route_number`)
									LIMIT ?, ?
					", $queryFrom, $queryTo);*/

		$countRoutes = 	$db->selectCell("SELECT count(*) as `count`
											FROM `routes`		
						");

		$baseUrl = htmURL;
		$countPages = ceil($countRoutes/$perPage);
	}

	require htmPATH."/templates/header.php";
	require htmPATH."/templates/main.php";
	require htmPATH."/templates/footer.php";



/*************************************************************************
*								Functions
**************************************************************************/

	function generateSearchClauses($searchFrom, $searchTo) {
		global $search_words;

		$searchFromWords =  (mb_strlen($searchFrom) >= 2) ? explode(" ", $searchFrom) : array();
		$searchToWords =  (mb_strlen($searchTo) >= 2) ? explode(" ", $searchTo) : array();
		$search_words = array_merge($searchFromWords, $searchToWords);

		$SEARCH_FROM_CLAUSE = '';
		$SEARCH_TO_CLAUSE = '';
		$searchFromPhrase = '';
		$searchToPhrase = '';


		if(!empty($searchFromWords)) {
			foreach ($searchFromWords as $word) {
				$searchFromPhrase .= $word.'* ';
			}

			$SEARCH_FROM_CLAUSE = "MATCH (`description`, `title`) 
									AGAINST ('$searchFromPhrase' IN BOOLEAN MODE)";
		}

		if(!empty($searchToWords)) {
			foreach ($searchToWords as $word) {
				$searchToPhrase .= $word.'* ';
			}

			$SEARCH_TO_CLAUSE = "MATCH (`description`, `title`) 
									AGAINST ('$searchToPhrase' IN BOOLEAN MODE)";
		}

		if(!empty($searchFromWords) && !empty($searchToWords)){
			$SEARCH_TO_CLAUSE = " AND ".$SEARCH_TO_CLAUSE;
		}

		return array(
			'from' => $SEARCH_FROM_CLAUSE,
			'to' => $SEARCH_TO_CLAUSE
		);
	}

?>