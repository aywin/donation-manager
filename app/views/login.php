<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Association - Athentification</title>
		<link rel="stylesheet" href="<?=asset('css/bootstrap.min.css')?>">
		<link rel="stylesheet" href="<?=asset('css/styles.css')?>">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="container" style="margin-top: 100px" align="center">
			<div class="panel panel-primary" style="width: 500px;">
				<div class="panel-heading">
			  		<h3 class="panel-title">Authentification</h3>
				</div>
				<div class="panel-body">
					<form action="<?=url('login/login')?>" method="POST" role="form">
						<legend></legend>
					
						<div class="form-group">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
						</div>
					
											
						<div class="form-group">
							<label for="password">Mot de passe</label>
							<input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
						</div>
					
						
					
						<button type="submit" class="btn btn-success">S'authentifier</button>
					</form>
				</div>
			</div>
		</div>


		<script src="<?=asset('js/jquery.js')?>"></script>
		<script src="<?=asset('js/bootstrap.min.js')?>"></script>
	</body>
</html>