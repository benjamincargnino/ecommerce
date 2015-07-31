<h2>Toutes mes catégories</h2>

<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-sm-2">Id</th>
			<th class="col-sm-2">Name</th>
			<th class="col-sm-6">Description</th>
			<th class="col-sm-3">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($aCategories as $oCategory): ?>
		<tr>
			<td><?= $oCategory->getId(); ?></td>
			<td><a href="<?= $oCategory->getUrl(); ?>"><?= $oCategory->getName(); ?></a></td>
			<td><?= $oCategory->getDescription(); ?></td> 
			<td><a class="btn btn-primary" href="http://localhost/ecommerce/index.php?page=category&action=edit&id=<?= $oCategory->getId(); ?>" id="modifier"> Modifier </a>
				<a class="btn btn-danger" href="http://localhost/ecommerce/index.php?page=category&action=remove&id=<?= $oCategory->getId(); ?>" id="remove"> Supprimer </a></td>   
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<a class="btn btn-primary" href="index.php?page=category&action=edit"> Ajouter une nouvelle catégorie</a>
<hr>