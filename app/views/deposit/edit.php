<?php template('header'); ?>

<h1 class="text-center">Contributions</h1>
<hr />

<form action="<?=url('deposit/update/'.$deposit->id)?>" method="POST" role="form">
	<legend>Modifier une contribution</legend>

	<div class="form-group">
		<label for="">Montant</label>
		<input type="text" class="form-control" name="amount" value="<?=$deposit->amount?>" required>
	</div>

	<div class="form-group">
		<label for="">Date de versement</label>
		<input class="form-control" data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" name="date" value="<?=$deposit->date?>" required>
	</div>

	<div class="form-group">
		<label for="">Date de sollicitation</label>
		<input type="text" class="form-control" value="<?=humanDate($sollicitation->date)?>" disabled>
	</div>

	<div class="form-group">
		<label for="">Contributeur</label>
		<input type="text" class="form-control" value="<?=$target->name()?>" disabled>
	</div>
	
	<input type="hidden" name="sollicitation_id" value="<?=$sollicitation->id?>" />
	<button type="submit" class="btn btn-primary">Modifier</button>
</form>


<?php template('footer'); ?>