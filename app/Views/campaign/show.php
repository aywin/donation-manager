<?php template('header'); ?>

<h1 class="text-center">Fiches de sollicitations de la compagne <?=$campaign->year?></h1>
<hr />

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Date début</th>
			<th>Date fin</th>
			<th>Solliciteur</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($sheets as $sheet): ?>
<?php $member = $sheet->member(); ?>
		<tr>
			<td><?=$sheet->id?></td>
			<td><?=$sheet->start_date?></td>
			<td><?=$sheet->end_date?></td>
			<td><?=$member->first_name . ' ' . $member->last_name?></td>
			<td class="actions">
				<a href="<?=url('sheet/show/' . $sheet->id)?>"><button type="button" class="btn btn-default btn-xs">Accéder</button></a>
				<a href="<?=url('sheet/edit/' . $sheet->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('sheet/destroy/' . $sheet->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
<?php endforeach; ?>		
	</tbody>
</table>

<?php template('footer'); ?>