<?php use ecommerce\model\dao\ProductManager; ?>

<h2>Toutes mes catégories</h2>

<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-sm-2">Id</th>
			<th class="col-sm-2">Name</th>
			<th class="col-sm-6">Description</th>
			<th class="col-sm-3">Nombre de produits</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($aProducts as $key => $value): ?>
		<tr>
			<td><?= $value['id'] ?></td>
			<td><?= $value['name'] ?></td>
			<td><?= $value['description'] ?></td>
			<td><?= $value['numberproducts'] ?></td>
		<?php endforeach; ?>
	</tbody>
</table>
<hr>