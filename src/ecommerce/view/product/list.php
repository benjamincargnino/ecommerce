<h2>Tous mes produits</h2>

<table class="table table-striped">
	<thead>
		<tr>
			<th class="col-sm-1">Id</th>
			<th class="col-sm-2">Name</th>
			<th class="col-sm-5">Description</th>
			<th class="col-sm-1">Price</th>
			<th class="col-sm-1">Etat</th>
			<th class="col-sm-3">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($aProducts as $oProduct): ?>
		<tr>
			<td><?= $oProduct->getId(); ?></td>
			<td><a href="<?= $oProduct->getUrl(); ?>"><?= $oProduct->getName(); ?></a></td>
			<td><?= $oProduct->getShortDescription(50); ?>
			<br><?php
			foreach($oProduct->getCategories() as $category){  ?>
			<span class="label label-success"><?php echo $category->getName() ?></span>
			<?php } ?>
			</td>
			<td><?= $oProduct->getPrice(); ?></td>
			<td><a href="http://localhost/ecommerce/index.php?page=product&action=archive&id=<?= $oProduct->getId(); ?>" class="btn btn-<?= $oProduct->getActive() == 1?"success":"danger"; ?> btn-xs"><span class="glyphicon glyphicon-<?= $oProduct->getActive() == 1?"ok":"remove"; ?>"></span></a></td>  
			<td><a class="btn btn-primary" href="http://localhost/ecommerce/index.php?page=product&action=edit&id=<?= $oProduct->getId(); ?>" id="modifier"> Modifier </a>
				<a class="btn btn-danger" href="http://localhost/ecommerce/index.php?page=product&action=remove&id=<?= $oProduct->getId(); ?>" id="remove"> Supprimer </a></td>   
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<a class="btn btn-primary" href="index.php?page=product&action=edit"> Ajouter un nouveau produit</a>
<hr>
