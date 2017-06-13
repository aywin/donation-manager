<?php template('header'); ?>

<h1 class="text-center">Les organismes</h1>
<hr />

<form action="<?=url('organization/store')?>" method="POST" role="form">
	<legend>Ajouter un organisme</legend>

	<div class="form-group">
		<label for="">Nom d'organisme</label>
		<input type="text" class="form-control" name="title" placeholder="Nom" required>
	</div>

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php template('footer'); ?>



