<?php template('header'); ?>

<h1 class="text-center">Départements</h1>
<hr />

<form action="<?=url('department/store')?>" method="POST" role="form">
	<legend>Ajouter un département</legend>

	<div class="form-group">
		<label for="">Nom du épartement</label>
		<input type="text" class="form-control" name="title" placeholder="Nom du département" required>
	</div>


	<div class="form-group">
		<label for="">Faculté</label>
		<select name="faculty_id" class="form-control">
		<?php foreach ($faculties as $faculty): ?>
			<option value="<?=$faculty->id?>"><?=$faculty->title?></option>
		<?php endforeach; ?>
		</select>
	</div>

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php template('footer'); ?>