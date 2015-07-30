<?php
use ecommerce\model\Comment;
use ecommerce\model\Product;

/* @var $oProduct Product */
?>


<div class="content clearfix">

	
	<div class="thumbnail">
		<img class="img-responsive img-rounded" src="<?php echo $oProduct->getImage(); ?>" alt="">
		
		<div class="caption-full">
			<h4 class="pull-right"><?php echo $oProduct->getPrice(); ?> &euro;</h4>
			<h4><a href="index.php?page=product&action=show&id=<?php echo $oProduct->getId(); ?>"><?php echo $oProduct->getName(); ?></a>
			</h4>
			<p><?php echo $oProduct->getShortDescription(300); ?></p>
		</div>
		
		<p>
			<?php
			foreach($aCategories as $category){  ?>
			<span class="label label-success"><?php echo $category->getName() ?></span>
			<?php }  ?>
		</p>
		<div class="ratings">
			<p class="pull-right"><?php echo count($aComments) ?> reviews</p>
			
			<p>
				<?php for($i=0; $i<=4; $i++ ) { ?>
				<?php if ($i < $oProduct->getRating()){  ?>
				<span class="glyphicon glyphicon-star"></span>
				<?php } else { ?>
				<span class="glyphicon glyphicon glyphicon-star-empty"></span>
				<?php } ?>

				<?php } ?>
				<?php echo $oProduct->getRating() ?> stars
			</p>
		</div>
	</div>
	
	<p >
		<form id="cart-form" method="post" action="index.php?page=product&action=addtocart" class="form-inline">
			<input type="hidden" name="product" value="<?= $oProduct->getId(); ?>"/>
			<input type="number" name="quantity" class="form-control" value="1"/>
			<button class="btn btn-primary" type="submit" name="addToCart">
				<span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Ajouter au panier
			</button>
		</form>
	</p>


	<div id="test"></div>
	
	<div class="well">	
		<p>
			<form id="comment-form" method="post" action="index.php?page=product&action=comment" class="form-horizontal">
				<p>
					<div class="text-right">
						<button class="btn btn-primary" type="submit" id="add-comment" name="add-comment">
							<span class="glyphicon glyphicon-comment"></span>&nbsp;Ajouter un commentaire
						</button>
					</div>
				</p>
				<input type="hidden" name="product-id" value="<?= $oProduct->getId(); ?>"/>

				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" id="name" placeholder="Name">
					</div>
				</div>
				
				<div class="form-group">
					<label for="comment" class="col-sm-2 control-label">Commentaire</label>
					
					<div class="col-sm-10">
						<textarea class="form-control" name="comment" id="comment"></textarea>
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					
					<div class="col-sm-10">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
				</div>

				<div class="form-group">
					<label for="mark" class="col-sm-2 control-label">Rating</label>
					<div class="col-sm-10"><div class="stars"></div>
				</div>
			</div>
		</form>

	</p>

	<hr>



	<?php foreach ($aComments as $oComment): ?>
	<div class="row">
		<div class="col-md-12">
			<p>
				<div class="starscom" data-score="<?php echo $oComment->getMark(); ?>"></div>
			</p>
			<?= $oComment->getUser()->getFirstName(); ?>
			<span class="pull-right">
				posted	
				<?php	if($oComment->getDateOld()["years"] !== 0) { ?>
				<?php echo $oComment->getDateOld()["years"] . " years, ";;?>
				<?php } ?>
				<?php	if($oComment->getDateOld()["months"] !== 0) { ?>
				<?php echo $oComment->getDateOld()["months"] . " months and ";;?>
				<?php } ?>
				<?php echo $oComment->getDateOld()["days"] . " days ago";  ?></span>
				<p><?= $oComment->getComment(); ?></p>
			</div>
		</div>
		<hr>
	<?php endforeach; ?>

</div>

</div>



<hr>
<!-- Title -->
<div class="row">
	<div class="col-lg-12">
		<h3>Produit similaire</h3>
	</div>
</div>
<!-- /.row -->

<!-- Page Features -->
<div class="row text-center">
	<?php foreach ($aSimilarProducts as $oProductSimilar): ?>
	<div class="col-md-3 col-sm-6 hero-feature">
		<div class="thumbnail">
			<img src="<?php echo $oProductSimilar->getImage(); ?>" alt="">
			<div class="caption">
				<h3><?php echo $oProductSimilar->getName(); ?></h3>
				<h4><?php echo $oProductSimilar->getPrice(); ?> &euro;</h4>
				<p><?php echo $oProductSimilar->getShortDescription(75); ?></p>
				<p>
					<a href="#" class="btn btn-primary">Buy Now!</a> <a href="index.php?page=product&action=show&id=<?php echo $oProductSimilar->getId(); ?>" class="btn btn-default">More Info</a>
				</p>
			</div>
		</div>
	</div>
<?php endforeach; ?> 
</div>
<!-- /.row -->

<script>
$(function() {

		$('form#comment-form').on('submit', function(e) {

            e.preventDefault();

            var $this = $(this);

				$.ajax({
					url: $this.attr('action'),
					type: $this.attr('method'),
					data: $('form#comment-form').serialize(),
						success: function(msg){
                    alert('Votre commentaire a bien été enregistré !');
                 },
                 error: function(){
                 	alert("failure");
                 }
              });
				});

				$('form#cart-form').on('submit', function(e) {

            e.preventDefault();

            var $this = $(this);

				$.ajax({
					url: $this.attr('action'),
					type: $this.attr('method'),

            data: $('form#cart-form').serialize(),
            success: function(msg){
                    alert('Votre produit a bien été ajouté au panier !');
                 },
                 error: function(){
                 	alert("failure");
                 }
              });
			});

			});
</script>