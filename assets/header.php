<?php require_once( 'php-header.php' ); ?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Pub Quiz">
		<meta name="author" content="me@luke.sx">
		<link rel="icon" href="assets/img/njh-icon.png" type="image/png"/>
		<title>Nathan Holliday</title>

		<link rel="stylesheet"
		      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
		      integrity="sha256-916EbMg70RQy9LHiGkXzG8hSg9EdNy97GazNG/aiY1w=" crossorigin="anonymous"/>
		<link rel="stylesheet" href="assets/css/black-tie.min.css">
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"
		        integrity="sha256-IFHWFEbU2/+wNycDECKgjIRSirRNIDp2acEB5fvdVRU=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"
		        integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
		<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
		<script src="http://timeago.yarp.com/jquery.timeago.js"></script>
	</head>
<body>
<nav class="navbar navbar-inverse navbar-grey">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
			        data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand animate" href="<?= $config['homepage']; ?>"></a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<?= $core->socialIcons(); ?>
				<li class='current'>
					<?= $core->navLogin(); ?>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="nav-border"></div>
<?php // $core->debug($_SESSION); ?>