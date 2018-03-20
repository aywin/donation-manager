<?php template('header'); ?>

<h1 class="text-center">Sollicitations</h1>
<hr />

<form action="<?=url('sollicitation/update/'.$sollicitation->id)?>" method="POST" role="form">
	<legend>Modifier la sollicitation</legend>

	<div class="form-group">
		<label for="">Sollicité</label>
		<select class="form-control" name="target_id">
			<option disabled>ORGANISMES</option>
		<?php foreach ($organizations as $organization): ?>
			<option value="<?=$organization->id?>" <?php if($organization->id==$sollicitation->target_id) echo "selected";?>><?=$organization->title?></option>
		<?php endforeach; ?>	
			<option disabled>MEMBRES</option>
		<?php foreach ($members as $member): ?>
			<option value="<?=$member->id?>" <?php if($member->id==$sollicitation->target_id) echo "selected";?>><?=$member->first_name . ' ' . $member->last_name?></option>
		<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="">Date de sollicitation</label>
		<input data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" class="form-control" name="date" value="<?=$sollicitation->date?>" required>
	</div>

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>


<?php template('footer'); ?>



