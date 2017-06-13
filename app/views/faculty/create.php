<?php template('header'); ?>

<form action="<?=url('faculty/store')?>"" method="POST" role="form">
	<legend>Ajouter une faculté</legend>

	<div class="form-group">
		<label for="">Nom de la faculté</label>
		<input type="text" class="form-control" name="title" placeholder="Nom" required>
	</div>

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php template('footer'); ?>