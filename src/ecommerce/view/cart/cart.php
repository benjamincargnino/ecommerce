<h1>Mon panier</h1>

<?php if (count($aCart) > 0): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>image</th>
            <th>produit</th>
            <th>prix unitaire</th>
            <th width="100">quantité</th>
            <th>total</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($aCart as $oProduct): ?>
            <?php /* @var $oProduct \ecommerce\model\CartProduct */ ?>
            <tr>
                <form action="" method="post">
                    <input type="hidden" name="product" value="<?= $oProduct->getId(); ?>"/>
                    <td><a href="<?= $oProduct->getUrl(); ?>"> <img src="<?= $oProduct->getImage(); ?>" alt=""
                                                                    class="img-responsive pull-left img-rounded"/></a>
                    </td>
                    <td><a href="<?= $oProduct->getUrl(); ?>"><?= $oProduct->getName(); ?></a></td>
                    <td><?= $oProduct->getPrice(); ?>€</td>
                    <td><input type="number" name="quantity" class="form-control"
                               value="<?= $oProduct->getQuantity(); ?>"/></td>
                    <td><?= $oProduct->getTotal(); ?>€</td>
                    <td>
                        <ul class="list-unstyled">
                            <li>
                                <button type="submit" name="edit" value="edit" class="btn btn-success"><span
                                        class="glyphicon glyphicon-edit"></span>&nbsp;Modifier
                                </button>
                            </li>
                            <li>
                                <button type="submit" name="remove" value="remove" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-remove"></span>&nbsp;Supprimer
                                </button>
                            </li>
                        </ul>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right">Total :</td>
            <td colspan="2"><?= $fTotal; ?>€</td>
        </tr>
        </tfoot>
    </table>
    <a href="index.php?page=product&action=confirmation" class="btn btn-primary pull-right">Valider ma commande</a>
    <div class="clearfix"></div>

<?php else: ?>
    <p><strong>Vous n'avez rien dans votre panier !</strong></p>
<?php endif; ?>
