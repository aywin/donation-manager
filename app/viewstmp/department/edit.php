<?php template('header'); ?>

<h1 class="text-center">Départements</h1>
<hr />

<form action="<?=url('department/update/'.$department->id)?>" method="POST" role="form">
	<legend>Modifier un département</legend>

	<div class="form-group">
		<label for="">Département</label>
		<input type="text" class="form-control" name="title" placeholder="Nom du département" value="<?=$department->title?>" required>
	</div>

	<div class="form-group">
		<label for="">Faculté</label>
		<select name="faculty_id" class="form-control">
		<?php foreach ($faculties as $faculty): ?>
			<option value="<?=$faculty->id?>" <?php if($faculty->id==$department->faculty_id) echo "selected";?>><?=$faculty->title?></option>
		<?php endforeach; ?>
		</select>
	</div>	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php template('footer'); ?>