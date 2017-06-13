<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Association des anciens diplomés</title>
		<link rel="stylesheet" href="<?=asset('css/bootstrap.min.css')?>">
		<link rel="stylesheet" href="<?=asset('css/datepicker.css')?>">
		<link rel="stylesheet" href="<?=asset('css/styles.css')?>">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid" style="margin: 0 240px"> 
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Association</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav" style="border-left: 1px grey solid;">
						<li><a href="<?=url('')?>">Acceuil</a></li>
						<li><a href="<?=url('group/index')?>">Comités</a></li>
						<li><a href="<?=url('member/index')?>">Membres</a></li>
						<li><a href="<?=url('organization/index')?>">Organismes</a></li>
						<li><a href="<?=url('campaign/index')?>">Compagnes</a></li>
						<li><a href="<?=url('sheet/index')?>">Fiches</a></li>
						<li><a href="<?=url('faculty/index')?>">Facultés</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
					<form method="POST" action="<?=url('member/search')?>" class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" name="search" placeholder="Chercher un membre">
						</div>
						<button type="submit" class="btn btn-default">Recherce</button>
					</form>
						<li><a href="<?=url('login/logout')?>">Se déconnecter</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<div class="container">