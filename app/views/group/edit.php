<?php template('header'); ?>

<h1 class="text-center">Comités</h1>
<hr />

<form action="<?=url('group/update/'.$group->id)?>" method="POST" role="form">
	<legend>Modifier une comité</legend>

	<div class="form-group">
		<label for="">Comité</label>
		<input type="text" class="form-control" name="title" placeholder="Comité" value="<?=$group->title?>" required>
	</div>

	
	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php template('footer'); ?>



