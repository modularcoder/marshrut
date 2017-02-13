<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<title><?php
		if ((isset($route_number)) && (isset($route_type))) {
			echo $route_number.' '.$routeTypes[$route_type].' | ';
			
					/* $route_number;
			if($route_type==1) {
				echo ' երթուղային - Երևանի տրանսպորտային ուղեցույց';
			}
			elseif ($route_type==2) {
				echo ' ավտոբուս - Երևանի տրանսպորտային ուղեցույց';
			}
			else {
				echo ' տրոլեյբուս - Երևանի տրանսպորտային ուղեցույց';
			} */
		}
		elseif ($isMakingSearch) {
			if(mb_strlen($searchFrom) > 2) {
	  			echo '«'.$searchFrom;
				if(mb_strlen($searchTo) < 3) {
					echo '» որոնում';
				}
	  		};
	  		if(mb_strlen($searchFrom) > 2 && mb_strlen($searchTo) > 2) {
	  			echo ' - ';
	  		};
	  		if(mb_strlen($searchTo) > 2) {
				if(mb_strlen($searchFrom) < 3) {
					echo '«';
				};
	  			echo $searchTo.'» որոնում';
	  		};
			echo ' | ';
		}
		elseif ($isAbout) {
			echo 'Կայքի մասին | ';
		}
		elseif ($isHome) {
			echo 'Գլխավոր էջ | ';
		}
		else {
		}
		?>Երևանի տրանսպորտային ուղեցույց</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="description"			content="Երևան քաղաքի հասարակական տրանսպորտային միջոցների ուղեցույց" />
		<meta name="keywords"				content="երևան, երեվան, տրանսպորտ, ճանապարհացույց, մարշրուտ, մարշրուտինֆո, ուղեցույց, մարշրուտկա, մարշուտկա, մարշուտնի, ереван, эреван, транспорт, маршрутинфо, маршутинфо, путеводитель, маршрут, маршут, маршрутное такси, маршрутка, маршутка, erevan, yerevan, public transport, transport, route shower, marshrut, marshut, marshrutinfo, guide, marshrutka, marshutka, marshutni" />
		<meta name="viewport"				content="width=device-width">
		<meta name='yandex-verification'	content='7f759587ee01c7ff' />

		<meta property="fb:app_id"			content="498903966798683" />
		<meta property="og:description"		content="Երևան քաղաքի հասարակական տրանսպորտի ուղեցույց" />
		<meta property="og:image"			content="http://marshrut.info/public/img/logo.jpg" />
		<meta property="og:title"			content="Երևանի տրանսպորտային ուղեցույց" />
		<meta property="og:url"				content="http://marshrut.info/" />

		<link rel="icon" type="image/ico" href="favicon.ico">

		<link rel="stylesheet" href="<?= htmDIR ?>css/bootstrap-theme.css">
		<link rel="stylesheet" href="<?= htmDIR ?>css/bootstrap.css">
		<link rel="stylesheet" href="<?= htmDIR ?>css/chosen/chosen.css">
		<link rel="stylesheet" href="<?= htmDIR ?>css/fancybox/jquery.fancybox.css">
		<link rel="stylesheet" href="<?= htmDIR ?>css/jscrollpane/jquery.jscrollpane.css">

		<link rel="stylesheet/less" type="text/css" href="<?= htmDIR ?>css/main.less" />


		<script src="<?= htmDIR ?>js/vendor/less-1.4.1.min.js" type="text/javascript"></script>
		<script src="<?= htmDIR ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script>
			var htmDIR = '<?= htmDIR ?>';
			var htmURL = '<?= htmURL ?>';
		</script>
	</head>
	<body>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/hy_AM/all.js#xfbml=1&appId=498903966798683";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<header itemscope itemtype="http://schema.org/Thing">
			<div class="navbar navbar-fixed-top" style="overflow: hidden;">
					
					<a class="navbar-brand hidden-xs" href="<?= htmURL ?>">
						<span itemprop="name">
							<img itemprop="image" itemprop="description" src="<?= htmDIR ?>img/logo (37x48).png" style="margin-right:5px;"></img>
							Երևանի տրանսպորտային ուղեցույց
						</span>
					</a>

					

					<ul class="nav navbar-nav hidden-xs">
						<li>
							<a href="<?= htmURL ?>?about">
								<i class="glyphicon glyphicon-info-sign"></i>
								Կայքի մասին
							</a>
						</li>
						<!-- <li>
							<a href="<?= htmURL ?>">
								<i class="glyphicon glyphicon-envelope"></i>
								Հետադարձ կապ
							</a>
						</li> -->
					</ul>


					<ul class="nav navbar-nav visible-xs">
						<li>
							<a href="<?= htmURL ?>">
								<img src="<?= htmDIR ?>img/logo (37x48).png" style="margin-top: -9px; padding-right: 7px;"></img>
								<div style="float: right; font-weight: bold; padding-top: 7px;">marshrut.info</div>
							</a>
						</li>
						<li>
							<a href="<?= htmURL ?>?about">
								<i class="glyphicon glyphicon-info-sign"></i>
							</a>
						</li>
						<!-- <li>
							<a href="<?= htmURL ?>">
								<i class="glyphicon glyphicon-envelope"></i>
							</a>
						</li> -->
					</ul>
			</div>
			<meta itemprop="url" content="http://marshrut.info/" />
		</header>