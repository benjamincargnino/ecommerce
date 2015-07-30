<?php
    use ecommerce\model\Comment;
    use ecommerce\model\Category;
?>

<h1>Edition catégorie :</h1>

<form enctype="multipart/form-data" class="form-horizontal" action="index.php?page=category&action=edit" method="post" name="addProduct" role="form">

    <?php if ($oCategory->getId()){ ?>
        <input type="hidden" name="category-id" value="<?= $oCategory->getId(); ?>"/>
    <?php } ?>

    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>

        <div class="col-sm-10">
            <input type="name" class="form-control" name="name" id="name" placeholder="Nom"  value="<?= $oCategory->getName(); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>

        <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description"><?php echo $oCategory->getDescription(); ?></textarea>
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
            <button type="reset" class="btn" name="annuler" value="subscribe">Annuler</button>
            <button type="submit" class="btn btn-primary" name="valider" value="subscribe">Valider</button>
        </div>
    </div>
</form>

