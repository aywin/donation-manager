<?php template('header'); ?>

<h1 class="text-center">Contributions</h1>
<hr />

<form action="<?=url('deposit/store')?>" method="POST" role="form">
	<legend>Ajouter une contribution</legend>

	<div class="form-group">
		<label class="control-label">Montant</label>
		<div class="input-group">
			<span class="input-group-addon">$</span>
			<input type="number" min="1" class="form-control" name="amount" placeholder="" required>
		</div>
	</div>

	<div class="form-group">
		<label for="">Date de versement</label>
		<input class="form-control" data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" name="date" placeholder="" required>
	</div>
	<?php if($sollicitation): ?>
	<div class="form-group">
		<label for="">Date de sollicitation</label>
		<input data-provide="datepicker" id="datepick" data-date-format="yyyy-mm-dd" class="form-control" value="<?=humanDate($sollicitation->date)?>" disabled>
	</div>

	<div class="form-group">
		<label for="">Contributeur</label>
		<input type="text" class="form-control" value="<?=$target->name()?>" disabled>
	</div>

	<input type="hidden" name="sollicitation_id" value="<?=$sollicitation->id?>" />

	<?php else: ?>
	<div class="form-group">
		<label for="">Contributeur</label>
		<select class="form-control" name="sollicitation_id">
			<option disabled>LES MEMBRES</option>
		<?php foreach ($sheet->sollicitations() as $sollicitation): ?>
			<?php if($sollicitation->target()->isMember()): ?>
			<option value="<?=$sollicitation->id?>"><?=$sollicitation->target()->name()?></option>
			<?php endif; ?>
		<?php endforeach; ?>
			<option disabled>LES ORGANISMES</option>
		<?php foreach ($sheet->sollicitations() as $sollicitation): ?>
			<?php if(!$sollicitation->target()->isMember()): ?>
			<option value="<?=$sollicitation->id?>"><?=$sollicitation->target()->name()?></option>
			<?php endif; ?>
		<?php endforeach; ?>		
		</select>
	</div>
	<?php endif;?>
	
	<input type="hidden" name="sollicitation_id" value="<?=$sollicitation->id?>" />
	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>


<?php template('footer'); ?>