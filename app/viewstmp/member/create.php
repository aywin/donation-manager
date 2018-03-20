<?php template('header'); ?>

<h1 class="text-center">Membres</h1>
<hr />

<form action="<?=url('member/store')?>" method="POST" role="form">
	<legend>Ajouter un membre</legend>

	<div class="form-group">
		<label for="">Prénom</label>
		<input type="text" class="form-control" name="first_name" placeholder="Prénom" required>
	</div>

	<div class="form-group">
		<label for="">Nom</label>
		<input type="text" class="form-control" name="last_name" placeholder="Nom" required>
	</div>

	<div class="form-group">
		<label for="">Date de naissance</label>
		<input data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" class="form-control" name="birthday" required>
	</div>

	<div class="form-group">
		<label for="">Adresse</label>
		<input type="text" class="form-control" name="address" placeholder="Adresse" required>
	</div>

	<div class="form-group">
		<label for="">Comité</label>
		<select class="form-control" name="group_id">
		<?php foreach ($groups as $group): ?>
			<option value="<?=$group->id?>"><?=$group->title?></option>
		<?php endforeach; ?>
		</select>
	</div>

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>


<?php template('footer'); ?>



