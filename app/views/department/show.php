<?php template('header'); ?>

<h1 class="text-center">Départment <?=$department->title?>, <?=$faculty->title?></h1>
<hr />

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nom du diplôme</th>
			<th>Montant de côtisation</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($diplomas as $diploma): ?>
		<tr>
			<td><?=$diploma->id?></td>
			<td><?=$diploma->title?></td>
			<td>$<?=$diploma->amount?></td>
			<td class="actions">
				<a href="<?=url('diploma/edit/'.$diploma->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('diploma/destroy/'.$diploma->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
<?php endforeach; ?>		
	</tbody>
</table>

<?php template('footer'); ?>