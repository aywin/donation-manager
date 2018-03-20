<?php template('header'); ?>

<h1 class="text-center"><?=$organization->title?></h1>

<ul class="nav nav-tabs">
  <li class="active"><a href="#infos" data-toggle="tab" aria-expanded="true">Infos</a></li>
  <li class=""><a href="#contributions" data-toggle="tab" aria-expanded="false">Contributions</a></li>
  <li class=""><a href="#phone" data-toggle="tab" aria-expanded="false">Ajouter un téléphone</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="infos">
    
<table class="table table-hover member">
	<tbody>
		<tr>
			<td style="width: 400px;">#</td>
			<td><?=$organization->id?></td>
		</tr>
		<tr>
			<td>Titre</td>
			<td><?=$organization->title?></td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td>
				<?php foreach($organization->phones() as $phone): ?>
					<?=$phone->number?> 
					<a href="<?=url('phone/edit/'.$phone->id)?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="<?=url('phone/destroy/'.$phone->id)?>" class="confirmation"><span class="glyphicon glyphicon-remove"></span></a>
					<br />
				<?php endforeach; ?>
			</td>
		</tr>										
	</tbody>
</table>


  </div>



 <div class="tab-pane fade" id="contributions">

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Montant</th>
				<th>Date</th>
				<th>Sollicité par</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($deposits as $deposit): ?>
	<?php $solicitor = $deposit->sollicitation()->sheet()->member(); ?>
			<tr>
				<td><?=$deposit->id?></td>				
				<td><?=$deposit->amount?></td>				
				<td><?=humanDate($deposit->date)?></td>		
				<td><?=$solicitor->first_name . ' ' . $solicitor->last_name?></td>	
				<td class="actions">
					<a href="<?=url('deposit/edit/'.$deposit->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
					<a href="<?=url('deposit/destroy/'.$deposit->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
				</td>
			</tr>	
	<?php endforeach; ?>						
		</tbody>
	</table>
</div>


 <div class="tab-pane fade" id="phone">

<form action="<?=url('phone/store')?>" method="POST" role="form">
<legend></legend>
	<div class="form-group">
		<label for="">Numéro de téléphone</label>
		<input type="text" class="form-control" name="number" placeholder="" required>
	</div>

	<input type="hidden" name="target_id" value="<?=$organization->id?>" />

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

</div>

</div>

<?php template('footer'); ?>