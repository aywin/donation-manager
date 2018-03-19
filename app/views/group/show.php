<?php template('header'); ?>

<h1 class="text-center"><?=$group->title?></h1>
<hr />
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nom & Prénom</th>
			<th>Date de naissance</th>
			<th>Téléphone</th>
			<th>Adresse</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($members as $member): ?>
		<tr>
			<td><?=$member->id?></td>
			<td><a href="<?=url('member/show/'.$member->id)?>"><?=$member->first_name . ' ' . $member->last_name?></a></td>
			<td><?=humanDate($member->birthday)?></td>
			<td>
			<?php foreach ($member->phones() as $phone): ?>
				<?=$phone->number?>
				<br />
			<?php endforeach; ?>
			</td>
			<td><?=$member->address?></td>
			<td class="actions">
				<a href="<?=url('member/show/'.$member->id)?>"><button type="button" class="btn btn-default btn-xs">Details</button></a>
				<a href="<?=url('member/edit/'.$member->id)?>"><button type="button" class="btn btn-default btn-xs">Editer</button></a>
				<a href="<?=url('member/destroy/'.$member->id)?>" class="confirmation"><button type="button" class="btn btn-default btn-xs">Supprimer</button></a>
			</td>
		</tr>
<?php endforeach; ?>				
	</tbody>
</table>


<?php template('footer'); ?>