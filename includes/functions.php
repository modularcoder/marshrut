<?php
    
    $pagination_defaults = array(
        'paged' => (isset($_GET['paged'])) ? intval($_GET['paged']) : 1,
        'count' => 1,
        'baseUrl' => htmURL,
        'range' => 3,
        'templatePath' => htmPATH.'/templates/pagination.php',
    );

    function pagination($args = array()) {
        global $pagination_defaults;
        $args = array_merge($pagination_defaults, $args);

        extract($args);

        $activePage = $paged;
        $countPages = $count;

        include $templatePath;
    }

    function getPageUrl2($urlBase, $pageNum) {
        if($pageNum==1) {
            return $urlBase;
        }

        if(strpos($urlBase, '?') === false) {
            return $urlBase."?paged=$pageNum";
        }
        else {
           return $urlBase."&paged=$pageNum"; 
        }
    }

    function getPageUrl($urlBase, $pageNum) {

        if($pageNum == 1) {
            $urlBase = (!empty($urlBase)) ? "?$urlBase" : "";
            return htmURL."$urlBase";
        }

        if(!empty($urlBase)) {
            return htmURL."?$urlBase&paged=$pageNum";
        }
        else {
            return htmURL."?paged=$pageNum";
        }

    }

    function getRouteUrl($routeId, $routeTitle = '') {
         return htmURL."?route=$routeId/".arm2translit($routeTitle);
    }

	function highlightWords($text, $words) {
        /*** loop of the array of words ***/
        foreach ($words as $word)
        {
            /*** quote the text for regex ***/
            // $word = preg_quote($word);
            /*** highlight the words ***/
            // $text = preg_replace("/\b($word)\b/i", '<span class="highlight_word">\1</span>', $text);

			$pattern = '/('. preg_quote($word, '/') .')/ui';
  			$text = preg_replace($pattern, '<span class="label label-success">$1</span>' , $text );
        }
        /*** return the text ***/
        return $text;
	}

    function arm2translit($string) {
        $string = preg_replace(array('/[^\p{Armenian}a-zA-Z\d\-\s]/u', '!\s+!'), array('',' '), mb_strtolower($string, 'UTF-8'));
        
        /*$rules = array(
            'նն' => 'ն',
        );
        $string = strtr($string, $rules);*/
        
        $converter = array(
			'ա' => 'a',		'բ' => 'b',		'գ' => 'g',
			'դ' => 'd',		'ե' => 'e',		'զ' => 'z',
			'է' => 'e',		'ը' => 'y',		'թ' => 't',
			'ժ' => 'zh',	'ի' => 'i',		'լ' => 'l',
			'խ' => 'kh',	'ծ' => 'ts',	'կ' => 'k',
			'հ' => 'h',		'ձ' => 'dz',	'ղ' => 'gh',
			'ճ' => 'ch',	'մ' => 'm',		'յ' => 'y',
			'ն' => 'n',		'շ' => 'sh',	'ո' => 'o',
			'չ' => 'ch',	'պ' => 'p',		'ջ' => 'j',
			'ռ' => 'r',		'ս' => 's',		'վ' => 'v',
			'տ' => 't',		'ր' => 'r',		'ց' => 'c',
			'ու' => 'u',		'փ' => 'p',		'ք' => 'q',
			'և' => 'ev',	'օ' => 'o',		'ֆ' => 'f',
			' ո' => 'vo',	' - ' => '-',	' ' => '-'
		);

		$string = strtr($string, $converter);
        return $string;
    }

    $imgDefArgs = array(
        'url' => false,
        'id' => false,
        'width' => false,
        'height' => false,
        'subdir' => false,
        'class' => false,
    );

    function printImg($args) {
        global $imgDefArgs;
        $args = array_merge($imgDefArgs, $args);

        $imgUrl = retImg($args);
        $class = $args['class'] ? "class='{$args['class']}' " : '';

        if($imgUrl!=""){
            echo "<img src='$imgUrl' $class  />";
        }
        else {
            echo '';
        }
    }

    function retImg($args = false) {
        global $imgDefArgs;

        $args = array_merge($imgDefArgs, $args);

        $width = ($args['width']) ? "&w=".$args['width'] : "";
        $height = ($args['height']) ? "&h=".$args['height'] : "";
        $url = $args['url'];

        if($url) {
            return htmROOT."lib/timthumb.php?src=".$url.$width.$height;
        }
        else {
            return false;
        }
    }

	function inspect($array) {
		echo '<pre>'.print_r($array,1).'</pre>';
	}


?>