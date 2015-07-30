<?php
    use ecommerce\model\Comment;
    use ecommerce\model\Product;
?>

<h1>Edition produit :</h1>

<form enctype="multipart/form-data" class="form-horizontal" action="index.php?page=product&action=edit" method="post" name="addProduct" role="form">

    <?php if ($oProduct->getId()){ ?>
        <input type="hidden" name="product-id" value="<?= $oProduct->getId(); ?>"/>
    <?php } ?>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>

        <div class="col-sm-10">
            <input type="name" class="form-control" name="name" id="name" placeholder="Nom"  value="<?= $oProduct->getName(); ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="price" class="col-sm-2 control-label">Prix</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="price" placeholder="Prix"  value="<?php echo $oProduct->getPrice(); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>

        <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description"><?php echo $oProduct->getDescription() ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="categories" class="col-sm-2 control-label">Catégories</label>
        <div class="col-sm-10">
            <select multiple class="form-control"  name="categories[]"   id="categories" >
                <?php
                foreach($aCategories as $key=>$category){  ?>
                    <option value="<?php echo $category->getId() ?>" ><?php echo $category->getName() ?></option>
                <?php }  ?>
            </select>
        </div>
    </div>
	
	<div class="form-group">
		<label for="image"  class="col-sm-2 control-label" >Image</label>
		<div class="col-sm-10">
			<input type="file" name="image"   id="image">
		</div>
	</div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="reset" class="btn" name="subscribe" value="subscribe">Annuler</button>
            <button type="submit" class="btn btn-primary" name="subscribe" value="subscribe">Valider</button>
        </div>
    </div>
</form>


