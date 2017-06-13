<?php template('header'); ?>

<h1 class="text-center"><?=$faculty->title?></h1>
<a href="<?=url('department/create')?>"><button type="button" class="btn btn-primary">Ajouter un département</button></a>
<a href="<?=url('diploma/create')?>"><button type="button" class="btn btn-success">Ajouter un diplôme</button></a>
<hr />
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Département</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($departments as $department): ?>
		<tr>
			<td><?=$department->id?></td>
			<td><?=$department->title?></td>
			<td class="actions">
				<a href="<?=url('department/show/'.$department->id)?>"><button type="button" class="btn btn-default btn-xs">Diplômes</button></a>				
				<a href="<?=url('department/edit/'.$department->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>				
				<a href="<?=url('department/destroy/'.$department->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php template('footer'); ?>