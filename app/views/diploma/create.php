<?php template('header'); ?>

<h1 class="text-center">Diplômes</h1>
<hr />

<form action="<?=url('diploma/store')?>" method="POST" role="form">
	<legend>Ajouter un diplôme</legend>

	<div class="form-group">
		<label for="">Titre du diplôme</label>
		<input type="text" class="form-control" name="title" placeholder="Titre" required="">
	</div>

	<div class="form-group">
		<label for="">Montant de côtisation</label>
		<div class="input-group">
			<span class="input-group-addon">$</span>
			<input type="number" min="1" class="form-control" name="amount" placeholder="Montant" required>
		</div>
	</div>

	<div class="form-group">
		<label for="">Département</label>
		<select class="form-control" name="department_id">
		<?php foreach ($faculties as $faculty): ?>
			<?php if($faculty->departments()): ?>
				<option disabled><?=$faculty->title?></option>
				<?php foreach ($faculty->departments() as $department): ?>
					<option value="<?=$department->id?>"><?=$department->title?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		</select>
	</div>

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php template('footer'); ?>