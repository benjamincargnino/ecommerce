<?php
use ecommerce\model\Comment;
use ecommerce\model\Product;

/* @var $oProduct Product */
?>

<h1> Liste des commentaires en attente de validation </h1>

<table class="table table-bordered">
	<tr class="row">
		<th>Nom produit</th>
		<th>Name</th>
		<th>Email</th>
		<th>Commentaire</th>
		<th>Date</th>
		<th>Rating</th>
		<th>Validation du commentaire</th>
	</tr>	
	<?php foreach ($aAllComments as $oComment): ?>
	<tr class="row">
		<td class="col"><a href="index.php?page=product&action=show&id=<?php echo $oComment->getProduct()->getId(); ?>"><?php echo $oComment->getProduct()->getName(); ?></a></td>
		<td class="col"><?= $oComment->getName(); ?></td>
		<td class="col"><?= $oComment->getUser()->getEmail(); ?></td>
		<td class="col"><a href="index.php?page=comment&action=show&id=<?php echo $oComment->getProduct()->getId(); ?>&email=<?php echo $oComment->getUser()->getEmail(); ?>"><?= $oComment->getShortComment(10); ?></a></td>
		<td class="col"><?= $oComment->getDate(); ?></td>
		<td class="col"><div class="starscom" data-score="<?php echo $oComment->getMark(); ?>"></td></td>
		<td class="col"></td>
	</tr>
<?php endforeach; ?>
</table>