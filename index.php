<?php
session_start();

use ecommerce\controller\Controller;

use ecommerce\controller\ProductController;
use ecommerce\controller\LoginController;
use ecommerce\controller\CategoryController;
use ecommerce\controller\CommentController;
use ecommerce\controller\AccountController;

use ecommerce\model\dao\CategoryManager;
use ecommerce\model\dao\ProductManager;
use ecommerce\model\dao\UserManager;

require 'inc/conf.inc.php';

$sPage = 'home';
if (array_key_exists('page', $_GET)) {
	$sPage = $_GET['page'];
}

switch ($sPage) {
	case "home":
	case "index":
			// header('location: index.php');	
	homeAction($sPage);
	break;
	case "login":
	$controller = new LoginController();
	break;
	case "product":
	$controller = new ProductController();
	break;
	case "category":
	$controller = new CategoryController();
	break;
	case "comment":
	$controller = new CommentController();
	break;
	case "account":
	$controller = new AccountController();
	break;
	default:
	header('HTTP/1.0 404 Not Found');
			//header('location: index.php');
}

function homeAction($sPage)
{
	
	require ROOT . 'inc/site.header.inc.php';
	$aCategories = CategoryManager::getAll();
	$aProducts = ProductManager::getRandom(4, 1);
	require ROOT . 'src/ecommerce/view/home.php';	
	require ROOT . 'inc/site.footer.inc.php';	
}	

