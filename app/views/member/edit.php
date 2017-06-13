<?php template('header'); ?>

<h1 class="text-center">Membres</h1>
<hr />

<form action="<?=url('member/update/'.$member->id)?>" method="POST" role="form">
	<legend>Modifier le membre</legend>

	<div class="form-group">
		<label for="">Prénom</label>
		<input type="text" class="form-control" name="first_name" placeholder="Prénom" value="<?=$member->first_name?>" required>
	</div>

	<div class="form-group">
		<label for="">Nom</label>
		<input type="text" class="form-control" name="last_name" placeholder="Nom" value="<?=$member->last_name?>" required>
	</div>

	<div class="form-group">
		<label for="">Date de naissance</label>
		<input data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" class="form-control" name="birthday" value="<?=$member->birthday?>" required>
	</div>

	<div class="form-group">
		<label for="">Adresse</label>
		<input type="text" class="form-control" name="address" placeholder="Adresse" value="<?=$member->address?>" required>
	</div>

	<div class="form-group">
		<label for="">Comité</label>
		<select class="form-control" name="group_id">
		<?php foreach ($groups as $group): ?>
			<option value="<?=$group->id?>" <?php if($group->id==$member->group_id) echo "selected"?>><?=$group->title?></option>
		<?php endforeach; ?>
		</select>
	</div>

	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>


<?php template('footer'); ?>



