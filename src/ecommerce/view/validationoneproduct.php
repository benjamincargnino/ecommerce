<?php
use ecommerce\model\Comment;
use ecommerce\model\Product;

/* @var $oProduct Product */
?>
<h1> Commentaire à valider ou supprimer </h1>

		<h2><a href="index.php?page=product&action=show&id=<?php echo $oComment->getProduct()->getId(); ?>"><?php echo $oComment->getProduct()->getName(); ?></a></h2>

		<h4><?= $oComment->getName(); ?></h4>
		<h5><?= $oComment->getUser()->getEmail(); ?></h5>
		<p><?= $oComment->getComment(); ?></p>
		<h6><?= $oComment->getDate(); ?><h6>
		<div class="starscom" data-score="<?php echo $oComment->getMark(); ?>"></div>
		<br>
<a class="btn btn-success" href="index.php?page=comment&action=validate&id=<?php echo $oComment->getProduct()->getId();?>&email=<?php echo $oComment->getUser()->getEmail(); ?>" id="validate"> Valider le commentaire </a>
<a class="btn btn-danger" href="index.php?page=comment&action=remove&id=<?php echo $oComment->getProduct()->getId();?>&email=<?php echo $oComment->getUser()->getEmail(); ?>" id="remove"> Supprimer le commentaire </a>
