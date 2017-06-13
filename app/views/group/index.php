<?php template('header'); ?>

<h1 class="text-center">Les comités de l'association</h1>
<a href="<?=url('group/create')?>"><button type="button" class="btn btn-primary">Ajouter une comité</button></a>
<a href="<?=url('member/create')?>"><button type="button" class="btn btn-success">Ajouter un membre</button></a>

<hr />

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Titre</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($groups as $group): ?>
		<tr>
			<td><?=$group->id?></td>
			<td><a href="<?=url('group/show/'.$group->id)?>"><?=$group->title?></a></td>
			<td class="actions">
				<a href="<?=url('group/show/'.$group->id)?>"><button type="button" class="btn btn-default btn-xs">Membres <span class="badge"><?=$group->countMembers()?></span></button></a>
				<a href="<?=url('group/edit/'.$group->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('group/destroy/'.$group->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
<?php endforeach; ?>				
	</tbody>
</table>


<?php template('footer'); ?>