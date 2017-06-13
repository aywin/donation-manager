<?php template('header'); ?>

<h1 class="text-center">Liste des facultés</h1>

<a href="<?=url('faculty/create')?>" class="btn btn-primary">Ajouter une faculté</a>
<a href="<?=url('department/create')?>" class="btn btn-success">Ajouter un département</a>
<a href="<?=url('diploma/create')?>" class="btn btn-default">Ajouter un diplôme</a>

<hr />
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Faculté</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($faculties as $faculty): ?>
		<tr>
			<td><?=$faculty->id?></td>
			<td><a href="<?=url('faculty/show/'.$faculty->id)?>"><?=$faculty->title?></a></td>
			<td class="actions">
				<a href="<?=url('faculty/edit/'.$faculty->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('faculty/destroy/'.$faculty->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Suprrimer</button></a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php template('footer'); ?>