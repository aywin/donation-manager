<?php template('header'); ?>

<h1 class="text-center">Sollicitations</h1>
<hr />

<form action="<?=url('sollicitation/store')?>" method="POST" role="form">
	<legend>Ajouter une sollicitation</legend>

	<div class="form-group">
		<label for="">Sollicité</label>
		<select class="form-control" name="target_id">
			<option disabled>Organismes</option>
		<?php foreach ($organizations as $organization): ?>
			<option value="<?=$organization->id?>"><?=$organization->title?></option>
		<?php endforeach; ?>	
			<option disabled>Membres</option>
		<?php foreach ($members as $member): ?>
			<option value="<?=$member->id?>"><?=$member->first_name . ' ' . $member->last_name?></option>
		<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="">Date de sollicitation</label>
		<input data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" class="form-control" name="date" required>
	</div>

	<input type="hidden" name="sheet_id" value="<?=$sheet->id?>" />

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>


<?php template('footer'); ?>



