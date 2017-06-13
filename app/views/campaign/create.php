<?php template('header'); ?>

<h1 class="text-center">Compagnes</h1>
<hr />

<form action="<?=url('campaign/store')?>" method="POST" role="form">
	<legend>Ajouter une compagne</legend>

	<div class="form-group">
		<label for="">Année</label>
		<input type="text" class="form-control" name="year" placeholder="Ex: 2016" pattern="\d{4}" required>
	</div>

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php template('footer'); ?>