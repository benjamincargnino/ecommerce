<h1>Détail de la commande</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-sm-2">id du produit</th>
                <th class="col-sm-3">Nom du produit</th>
                <th class="col-sm-3"> Prix HT</th>
                <th class="col-sm-3"> Prix TTC</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($oOrder as $oProduct): ?>
            <tr>
                <td><?= $oProduct->getId(); ?></td>
                <td><a href="index.php?page=product&action=show&id=<?=$oProduct->getId(); ?>"><?=$oProduct->getName(); ?></a></td>
                <td><?= $oProduct->getPrice(); ?>€</td>
                <td><?= $oProduct->getPriceTTC(); ?>€</td>   
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

