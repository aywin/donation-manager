<?php template('header'); ?>

<h1 class="text-center">Diplômes</h1>
<hr />

<form action="<?=url('diploma/update/'.$diploma->id)?>" method="POST" role="form">
	<legend>Editer le diplôme</legend>

	<div class="form-group">
		<label for="">Titre du diplôme</label>
		<input type="text" class="form-control" name="title" placeholder="Titre" value="<?=$diploma->title?>" required>
	</div>

	<div class="form-group">
		<label for="">Montant de côtisation</label>
		<div class="input-group">
			<span class="input-group-addon">$</span>
			<input type="number" min="1" class="form-control" name="amount" placeholder="Montant" value="<?=$diploma->amount?>" required>
		</div>
	</div>

	<div class="form-group">
		<label for="">Département</label>
		<select class="form-control" name="department_id">
		<?php foreach ($faculties as $faculty): ?>
			<option disabled><?=$faculty->title?></option>
			<?php foreach ($faculty->departments() as $department): ?>
				<option value="<?=$department->id?>" <?php if($department->id==$diploma->department_id) echo "selected"?>><?=$department->title?></option>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</select>
	</div>

	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php template('footer'); ?>