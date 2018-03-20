<?php template('header'); ?>

<h1 class="text-center">Compagnes</h1>
<a href="<?=url('campaign/create')?>"><button type="button" class="btn btn-primary">Ajouter une compagne</button></a>
<hr />

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th style="width: 100px">#</th>
			<th>Année</th>
			<th style="width: 500px"></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($campaigns as $campaign): ?>		
		<tr>
			<td><?=$campaign->id?></td>
			<td><?=$campaign->year?></td>
			<td class="actions">
				<a href="<?=url('campaign/show/'.$campaign->id)?>"><button type="button" class="btn btn-default btn-xs">Accèder aux fiches de sollicitations</button></a>
				<a href="<?=url('campaign/edit/'.$campaign->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('campaign/destroy/'.$campaign->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>

			</td>
		</tr>
<?php endforeach; ?>		
	</tbody>
</table>

<?php template('footer'); ?>