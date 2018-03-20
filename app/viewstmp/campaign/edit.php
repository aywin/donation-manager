<?php template('header'); ?>

<h1 class="text-center">Compagnes</h1>
<hr />

<form action="<?=url('campaign/update/'.$campaign->id)?>" method="POST" role="form">
	<legend>Modifier une compagne</legend>

	<div class="form-group">
		<label for="">Année</label>
		<input type="text" class="form-control" name="year" placeholder="year" value="<?=$campaign->year?>" required>
	</div>

	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php template('footer'); ?>