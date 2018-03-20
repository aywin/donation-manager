<?php template('header'); ?>

<h1 class="text-center">Les organismes</h1>
<a href="<?=url('organization/create')?>"><button type="button" class="btn btn-primary">Ajouter un organisme</button></a>
<hr />
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Titre</th>
			<th>Téléphones</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($organizations as $organization): ?>
		<tr>
			<td><?=$organization->id?></td>
			<td><a href="<?=url('organization/show/'.$organization->id)?>"><?=$organization->title?></a></td>
			<td>
				<?php foreach($organization->phones() as $phone): ?>
					<?=$phone->number?><br />
				<?php endforeach; ?>
			</td>
			<td class="actions">
				<a href="<?=url('organization/show/'.$organization->id)?>"><button type="button" class="btn btn-default btn-xs">Details</button></a>
				<a href="<?=url('organization/edit/'.$organization->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('organization/destroy/'.$organization->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php template('footer'); ?>