<?php template('header'); ?>

<h1 class="text-center">Fiche de sollicitation</h1>
<hr />

<form action="<?=url('sheet/update/'.$sheet->id)?>" method="POST" role="form">
	<legend>Modifier la fiche de sollicitation</legend>

	<div class="form-group">
		<label for="">Solliciteur</label>
		<select class="form-control" name="member_id">
		<?php foreach ($members as $member): ?>
			<option value="<?=$member->id?>" <?php if($member->id==$sheet->member_id) echo "selected"?>><?=$member->first_name . ' ' . $member->last_name?></option>
		<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="">Compagne</label>
		<select class="form-control" name="campaign_id">
		<?php foreach ($campaigns as $campaign): ?>
			<option value="<?=$campaign->id?>" <?php if($campaign->id==$sheet->campaign_id) echo "selected"?>><?=$campaign->year?></option>
		<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="">Date de début</label>
		<input data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" name="start_date" value="<?=$sheet->start_date?>" required>
	</div>

	<div class="form-group">
		<label for="">Date de fin</label>
		<input data-provide="datepicker" id="datepick2" data-date-format="yyyy-mm-dd" class="form-control" name="end_date" value="<?=$sheet->end_date?>" required>
	</div>


	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php template('footer'); ?>



