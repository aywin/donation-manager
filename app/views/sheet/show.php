<?php template('header');?>

<h1 class="text-center">Fiche de sollicitation</h1>

<a href="<?=url('deposit/create/'.$sheet->id)?>"><button type="button" class="btn btn-primary">Ajouter une contribution</button></a>
<a href="<?=url('sollicitation/create/'.$sheet->id)?>"><button type="button" class="btn btn-primary">Ajouter une sollicitation</button></a>
<hr />
<ul class="nav nav-tabs">
  <li class="active"><a href="#infos" data-toggle="tab" aria-expanded="true">Infos</a></li>
  <li class=""><a href="#diplomes" data-toggle="tab" aria-expanded="false">Diplômés</a></li>
  <li class=""><a href="#organismes" data-toggle="tab" aria-expanded="false">Organismes</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="infos">
    
<table class="table table-hover member">
	<tbody>
		<tr>
			<td>#</td>
			<td><?=$sheet->id?></td>
		</tr>
		<tr>
			<td>Solliciteur</td>
			<td><?=$member->first_name . ' ' . $member->last_name?></td>
		</tr>
		<tr>
			<td>Compagne</td>
			<td><?=$campaign->year?></td>
		</tr>		
		<tr>
			<td>Période</td>
			<td><small>Du</small> <?=humanDate($sheet->start_date) . ' <small>au</small> ' . humanDate($sheet->end_date)?></td>
		</tr>											
	</tbody>
</table>


	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Date de sollicitation</th>
				<th>Sollicité</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($sollicitations as $sollicitation): ?>
			<tr>
				<td><?=$sollicitation->id?></td>				
				<td><?=humanDate($sollicitation->date)?></td>				
				<td><?=$sollicitation->target()->name()?></td>		
				<td class="actions">
					<a href="<?=url('deposit/create/'.$sheet->id.'/'.$sollicitation->id)?>"><button type="button" class="btn btn-default btn-xs">Ajouter une contribution</button></a>
					<a href="<?=url('sollicitation/edit/'.$sollicitation->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
					<a href="<?=url('sollicitation/destroy/'.$sollicitation->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
				</td>		
			</tr>	
	<?php endforeach; ?>						
		</tbody>
	</table>

  </div>



 <div class="tab-pane fade" id="diplomes">

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Nom & Prénom</th>
				<th>Date de sollicitation</th>
				<th>Téléphone</th>
				<th>Montant</th>
				<th>Date de versement</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($deposits as $deposit): ?>
	<?php if($deposit->target()->member): ?>
	<?php $member = $deposit->target()->member(); ?>
			<tr>
				<td><a href="<?=url('member/show/'.$member->id)?>"><?=$member->first_name . ' ' . $member->last_name?></a></td>				
				<td><?=humanDate($deposit->sollicitation()->date)?></td>				
				<td>
				<?php foreach ($member->phones() as $phone): ?>
					<?=$phone->number?>
					<br />
				<?php endforeach; ?>
				</td>		
				<td><?=$deposit->amount?></td>		
				<td><?=humanDate($deposit->date)?></td>
				<td class="actions">
					<a href="<?=url('deposit/edit/'.$deposit->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
					<a href="<?=url('deposit/destroy/'.$deposit->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
				</td>		
			</tr>	
	<?php endif; ?>
	<?php endforeach; ?>						
		</tbody>
	</table>
</div>


 <div class="tab-pane fade" id="organismes">

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Organism</th>
				<th>Date de sollicitation</th>
				<th>Téléphone</th>
				<th>Montant</th>
				<th>Date de versement</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($deposits as $deposit): ?>
	<?php if(!$deposit->target()->member): ?>
	<?php $organization = $deposit->target()->organization(); ?>
			<tr>
				<td><?=$organization->title?></td>				
				<td><?=humanDate($deposit->sollicitation()->date)?></td>				
				<td>
				<?php foreach($organization->phones() as $phone): ?>
					<?=$phone->number?><br />
				<?php endforeach; ?>
				</td>		
				<td><?=$deposit->amount?></td>		
				<td><?=humanDate($deposit->date)?></td>		
				<td class="actions">
					<a href="<?=url('deposit/edit/'.$deposit->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
					<a href="<?=url('deposit/destroy/'.$deposit->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
				</td>				
			</tr>	
	<?php endif; ?>
	<?php endforeach; ?>						
		</tbody>
	</table>
</div>

</div>

<?php template('footer'); ?>