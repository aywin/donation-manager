<?php template('header'); ?>

<form action="<?=url('faculty/update/'.$faculty->id)?>"" method="POST" role="form">
	<legend>Editer une faculté</legend>

	<div class="form-group">
		<label for="">Nom de la faculté</label>
		<input type="text" class="form-control" name="title" placeholder="Nom" value="<?=$faculty->title?>" required>
	</div>

	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php template('footer'); ?>