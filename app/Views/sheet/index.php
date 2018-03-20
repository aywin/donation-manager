<?php template('header'); ?>

<h1 class="text-center">Fiches de sollicitations</h1>


<a href="<?=url('sheet/create')?>" class="btn btn-primary">Nouvelle fiche de sollicitation</a>

<hr />

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Date début</th>
			<th>Date fin</th>
			<th>Solliciteur</th>
			<th>Compagne</th>
			<th>Total des contributions</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($sheets as $sheet): ?>
<?php $member = $sheet->member(); ?>
		<tr>
			<td><?=$sheet->id?></td>
			<td><?=humanDate($sheet->start_date)?></td>
			<td><?=humanDate($sheet->end_date)?></td>
			<td><a href="<?=url('member/show/'.$member->id)?>"><?=$member->first_name . ' ' . $member->last_name?></a></td>
			<td><?=$sheet->campaign()->year?></td>
			<td><?=$sheet->getSum()?></td>
			<td class="actions">
				<a href="<?=url('sheet/show/' . $sheet->id)?>"><button type="button" class="btn btn-default btn-xs">Accèder</button></a>
				<a href="<?=url('sheet/edit/' . $sheet->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('sheet/destroy/' . $sheet->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
<?php endforeach; ?>		
	</tbody>
</table>

<?php template('footer'); ?>