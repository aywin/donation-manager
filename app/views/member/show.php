<?php template('header'); ?>

<h1 class="text-center"><?=ucfirst(strtolower($member->first_name)) . ' ' . strtoupper($member->last_name)?></h1>


<ul class="nav nav-tabs">
  <li class="active"><a href="#infos" data-toggle="tab" aria-expanded="true">Infos</a></li>
  <li class=""><a href="#diplomas" data-toggle="tab" aria-expanded="false">Dipômes</a></li>
  <li class=""><a href="#cotisations" data-toggle="tab" aria-expanded="false">Cotisations</a></li>
  <li class=""><a href="#contributions" data-toggle="tab" aria-expanded="false">Contributions</a></li>
  <li class=""><a href="#adddiploma" data-toggle="tab" aria-expanded="false">Ajouter un diplôme</a></li>
  <li class=""><a href="#addphone" data-toggle="tab" aria-expanded="false">Ajouter un téléphone</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="infos">
    
<table class="table table-hover member">
	<tbody>
		<tr>
			<td>Nom & Prénom</td>
			<td><?=$member->first_name . ' ' . $member->last_name?></td>
		</tr>
		<tr>
			<td>Date de naissance</td>
			<td><?=humanDate($member->birthday)?></td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td>
			<?php foreach ($member->phones() as $phone): ?>
				<?=$phone->number?>
				<a href="<?=url('phone/edit/'.$phone->id)?>"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="<?=url('phone/destroy/'.$phone->id)?>" class="confirmation"><span class="glyphicon glyphicon-remove"></span></a>
				<br />
			<?php endforeach; ?>
			</td>
		</tr>
		<tr>
			<td>Adresse</td>
			<td><?=$member->address?></td>
		</tr>
		<tr>
			<td>Comité</td>
			<td><?=$group->title?></td>
		</tr>										
	</tbody>
</table>


  </div>
  <div class="tab-pane fade" id="diplomas">

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Diplôme</th>
			<th>Département</th>
			<th>Faculté</th>
			<th>Cotisation</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($diplomas as $diploma): ?>
		<tr>
			<td><?=$diploma->id?></td>
			<td><?=$diploma->title?></td>
			<td><?=$diploma->department()->title?></td>
			<td><?=$diploma->department()->faculty()->title?></td>
			<td><?=$diploma->amount?></td>
			<td class="actions">
				<a href="<?=url('member/removeDiploma/'.$member->id.'/'.$diploma->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
<?php endforeach; ?>				
	</tbody>
</table>


  </div>
  <div class="tab-pane fade" id="cotisations">
<div class="container">
	<div class="col-md-8">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Montant</th>
					<th>Date de versement</th>
					<th>Sollicité par</th>
					<th>Date de sollicitation</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		<?php foreach($deposits as $deposit): ?>
		<?php if($deposit->subscription): ?>
		<?php $solicitor = $deposit->sollicitation()->sheet()->member(); ?>
				<tr>
					<td><?=$deposit->id?></td>				
					<td>$<?=$deposit->amount?></td>				
					<td><?=humanDate($deposit->date)?></td>		
					<td><?=$solicitor->first_name . ' ' . $solicitor->last_name?></td>		
					<td><?=humanDate($deposit->sollicitation()->date)?></td>	
					<td class="actions">
						<a href="<?=url('deposit/edit/'.$deposit->id)?>"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="<?=url('deposit/destroy/'.$deposit->id)?>" class="confirmation"><span class="glyphicon glyphicon-remove"></span></a>
					</td>	
				</tr>
		<?php endif; ?>
		<?php endforeach; ?>						
			</tbody>
		</table>
	</div>
	<div class="col-md-4">

		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Cotisations par an</h3>
		  </div>
		  <div class="panel-body">
		  	<table class="table">
		  		<thead>
		  			<th>Année</th>
		  			<th>Montant cotisé</th>
		  			<th>Montant requis</th>
		  		</thead>
		  		<tbody>
		<?php foreach($campaigns as $campaign): ?>
				<tr>
					<td><?=$campaign->year?></td>
					<td>$<?=$member->subscriptionByYear($campaign->year)?></td>
					<td>$<?=$member->amountRequired()?></td>
				</tr>
		<?php endforeach; ?>	
				</tbody>
			</table>	    
		  </div>
		</div>		
	</div>



  </div>
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
	<?php if(!$deposit->subscription): ?>
	<?php $solicitor = $deposit->sollicitation()->sheet()->member(); ?>
			<tr>
				<td><?=$deposit->id?></td>				
				<td>$<?=$deposit->amount?></td>				
				<td><?=humanDate($deposit->date)?></td>		
				<td><?=$solicitor->first_name . ' ' . $solicitor->last_name?></td>		
				<td class="actions">
					<a href="<?=url('deposit/edit/'.$deposit->id)?>"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="<?=url('deposit/destroy/'.$deposit->id)?>" class="confirmation"><span class="glyphicon glyphicon-remove"></span></a>
				</td>					
			</tr>
	<?php endif; ?>		
	<?php endforeach; ?>						
		</tbody>
	</table>
</div>




 <div class="tab-pane fade" id="adddiploma">

<form action="<?=url('member/addDiploma')?>" method="POST" role="form">
	<legend></legend>

	<div class="form-group">
		<label for="">Diplôme</label>
		<select class="form-control" name="diploma_id">
		<?php foreach ($faculties as $faculty): ?>
			<option disabled><?=$faculty->title?></option>
			<?php foreach ($faculty->departments() as $department): ?>
				<?php foreach ($department->diplomas() as $diploma): ?>
				<option value="<?=$diploma->id?>"><?=$diploma->title . ', '. $department->title?></option>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</select>
	</div>

	<input type="hidden" name="member_id" value="<?=$member->id?>" />

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>



 <div class="tab-pane fade" id="addphone">

<form action="<?=url('phone/store')?>" method="POST" role="form">
<legend></legend>
	<div class="form-group">
		<label for="">Numéro de téléphone</label>
		<input type="text" class="form-control" name="number" placeholder="" required>
	</div>

	<input type="hidden" name="target_id" value="<?=$member->id?>" />

	

	<button type="submit" class="btn btn-primary">Ajouter</button>
</form>

</div>

</div>

<?php template('footer'); ?>