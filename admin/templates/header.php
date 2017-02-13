<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Երևանի տրանսպորտային ուղեցույցի կառավարման վահանակ</title>
		<meta name="viewport" content="width=device-width" />

		<link rel="stylesheet" href="<?= admDIR ?>css/bootstrap.css">
		<link rel="stylesheet" href="<?= admDIR ?>css/bootstrap-theme.css">
		<link rel="stylesheet" href="<?= admDIR ?>css/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" href="<?= admDIR ?>css/fancybox/jquery.fancybox.css">

		<link rel="shortcut icon" href="<?= admURL ?>/favicon.ico" />

		<!-- <link rel="stylesheet/less" type="text/css" href="<?= admDIR ?>css/main.less" /> -->
		<link rel="stylesheet/less" type="text/css" href="<?= admDIR ?>css/admin.less" />
		<script src="<?= admDIR ?>js/vendor/less-1.4.1.min.js" type="text/javascript"></script>

		<script>
			var htmDIR = '<?= htmDIR ?>',
				htmURL = '<?= htmURL ?>',
				admURL = '<?= admURL ?>',
				admDIR = '<?= admDIR ?>';
		</script>
	</head>
	<body>
		<header>
			<div class="navbar navbar-fixed-top">
					
					<a class="navbar-brand hidden-xs" href="<?= admURL ?>">
						<img src="<?= admDIR ?>img/logo (36x48).jpg" style="margin-right:5px;"></img>
						<span style="font-size:17px;" >Կառավարման վահանակ</span>
					</a>

					

					<ul class="nav navbar-nav">
						<li>
							<a href="<?= admURL ?>">
								<span class="glyphicon glyphicon-road"></span>
								Երթուղիներ
							</a>
						</li>
						<li>
							<a href="<?= admURL ?>?waypoints">
								<span class="glyphicon glyphicon-record"></span>
								Կանգառներ
							</a>
						</li>
					</ul>

			</div>
		</header>