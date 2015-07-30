<?php 
use ecommerce\model\Product;
use ecommerce\model\User;

?>

<h2>Récapitulatif de ma commande</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Total HT</th>
			<th> T.V.A </th>
			<th>Total TTC</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $fTotal; ?>€</td>
			<td>20 %</td>
			<td><?= $tTotal; ?> €</td>
		</tr>			
	</tbody>
</table>

<h2>Coordonnées</h2>

<h4><?= $oUser->getFirstname(); ?></h4>
<h4><?= $oUser->getName(); ?></h4>
<h4><?= $oUser->getEmail(); ?></h4>
<h5><?= $oUser->getAddress(); ?></h5>
<h5><?= $oUser->getCp(); ?></h5><h5><?= $oUser->getCity(); ?></h5>


<a href="index.php?page=product&action=submitorder" class="btn btn-primary pull-right">Régler ma commande</a>
<div class="clearfix"></div>