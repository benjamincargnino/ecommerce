<h1>My orders</h1>

<h3> Toutes mes commandes </h3>


<?php if (count($aAllOrders) > 0): ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-sm-2">id de la commande</th>
            <th class="col-sm-4">date de la commande</th>
            <th class="col-sm-4"> détails de la commande</th>
            <th class="col-sm-2">Prix total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($aAllOrders as $oOrder): ?>
            <tr>
                <td><?= $oOrder->getId(); ?></td>
                <td><?=$oOrder->getDate(); ?></td>
                <td><a href="index.php?page=account&action=detailorder&id=<?= $oOrder->getId(); ?>"> Détail de la commande </a></td>
                <td><?= $oOrder->getTotalTTC(); ?>€</td>     
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p><strong>Vous n'avez rien dans votre panier !</strong></p>
<?php endif; ?>
