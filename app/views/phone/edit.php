<?php template('header'); ?>

<h1 class="text-center"><?=$target->name()?></h1>
<hr />


<form action="<?=url('phone/update/'.$phone->id)?>" method="POST" role="form">
<legend></legend>
	<div class="form-group">
		<label for="">Numéro de téléphone</label>
		<input type="text" class="form-control" name="number" placeholder="" value="<?=$phone->number?>"  required>
	</div>
	

	<button type="submit" class="btn btn-primary">Modifier</button>
</form>


<?php template('footer'); ?>



