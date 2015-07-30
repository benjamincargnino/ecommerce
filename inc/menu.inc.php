<?php
    use ecommerce\model\Category;
    use ecommerce\model\dao\CategoryManager;

?>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#e-commerce">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">My E-Commerce Website</a>
        </div>

        <div class="collapse navbar-collapse" id="e-commerce">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Accueil</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Catégories <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach (CategoryManager::getAll() as $oMenuCategory): ?>
                            <?php /* @var $oMenuCategory Category */ ?>
                            <li><a href="<?= $oMenuCategory->getUrl(); ?>"><span
                                        class="glyphicon glyphicon-tag"></span>&nbsp;<?= $oMenuCategory->getName(); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="index.php?page=account&action=myorders"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;My orders</a>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (!array_key_exists('email', $_SESSION)) : ?>
                    <li><a href="index.php?page=login&action=login"><span class="glyphicon glyphicon-user"></span>&nbsp;Connexion</a>
                    </li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
						class="glyphicon glyphicon-user"></span>&nbsp;<?= $_SESSION['email']; ?> <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="index.php?page=account&action=address"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Change address</a></li>
                            <li><a href="index.php?page=account&action=password"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Change password</a>
                            <li><a href="index.php?page=account&action=password"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Administration</a>
                            <li><a href="index.php?page=login&action=logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li><a href="index.php?page=product&action=cart"><span
                            class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Panier</a></li>
            </ul>
        </div>
    </div>
</nav>