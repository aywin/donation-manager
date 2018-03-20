<?php template('header'); ?>

<h1 class="text-center">Comités</h1>
<hr />

<form action="<?=url('group/store')?>" method="POST" role="form">
	<legend>Créer une comité</legend>

	<div class="form-group">
		<label for="">Comité</label>
		<input type="text" class="form-control" name="title" placeholder="Comité" required>
	</div>

	
	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php template('footer'); ?>



