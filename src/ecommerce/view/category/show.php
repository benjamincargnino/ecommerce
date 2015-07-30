<?php

use ecommerce\model\Category;

?>
<h1><?= $oCategory->getName(); ?></h1>

<p><?= $oCategory->getDescription(); ?></p>

<div class="thumbnail">
<a href="<?= $oCategory->getUrl(); ?>"><img src="<?= $oCategory->getImage(); ?>" alt=""/></a>
</div>

<?php if(isset($aProducts)) { ?>
<h2>Produit en avant</h2>

<div class="row">
    <?php foreach (array_slice($aProducts, 0, 4) as $oProduct): ?>
    <?php /* @var $oProduct \ecommerce\model\Product */ ?>
    <div class="col-sm-6">
        <div class="product thumbnail">
            <h3><a href="<?= $oProduct->getUrl(); ?>"><?= $oProduct->getName(); ?></a></h3>
            <p><?= $oProduct->getShortDescription(50); ?></p>
            <a href="<?= $oProduct->getUrl(); ?>"><img src="<?= $oProduct->getImage(); ?>" alt=""
             class="img-responsive pull-left img-rounded"/></a>
         </div>
     </div>
 <?php endforeach; ?>
</div>

<?php if(count($aProducts)>4) { ?>
<h3>Autres produits en vente</h3>
<ul class="list-unstyled">
    <?php foreach (array_slice($aProducts, 4, count($aProducts)) as $oProduct): ?>
    <?php /* @var $oProduct \ecommerce\model\Product */ ?>
    <li class="row"><a href="<?= $oProduct->getUrl(); ?>" class="col-xs-2"><img
        src="/<?= $oProduct->getImage(); ?>" alt=""
        class="img-responsive img-rounded"/></a>

        <h3 class="col-xs-2"><a href="<?= $oProduct->getUrl(); ?>"><?= $oProduct->getName(); ?></a></h3>

        <p class="col-xs-8"><?= $oProduct->getShortDescription(250); ?></p>
    </li>
<?php endforeach; ?>
</ul>

<?php } ?>

<?php } ?>