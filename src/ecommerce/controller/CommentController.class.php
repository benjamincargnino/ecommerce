<?php

namespace ecommerce\controller;

use ecommerce\model\CartProduct;
use ecommerce\model\Comment;
use ecommerce\model\dao\CartManager;
use ecommerce\model\dao\CategoryManager;
use ecommerce\model\dao\CommentManager;
use ecommerce\model\dao\OrderManager;
use ecommerce\model\dao\ProductManager;
use ecommerce\model\dao\UserManager;
use ecommerce\model\Product;
use ecommerce\model\User;

class CommentController
{

    public function __construct()
    {
     $sAction = 'home';
     if (array_key_exists('action', $_GET)) {
        $sAction = $_GET['action'];
    }

    $sFunction = lcfirst($sAction) . 'Action';

    require ROOT . 'inc/site.header.inc.php';

                // check if function exists in the current class :
    if (method_exists($this, $sFunction)) {
                    // call the function
        $this->$sFunction();
    } else {
        $this->homeAction();
    }
    require ROOT . 'inc/site.footer.inc.php';
}

private function validationAction()
{
                //no id => redirect home
    if (array_key_exists('id', $_GET)) {
        $iId = intval($_GET['id']);

        $oProduct = ProductManager::get($iId);

                // product not found => redirect home
        if (null === $oProduct) {
            $this->homeAction();
            return;
        } else {
            $aAllComments = CommentManager::getAllComments($oProduct);
            require ROOT . 'src/ecommerce/view/validation.php';
        }

    } else {
        $aAllComments = CommentManager::getAllComments();
        require ROOT . 'src/ecommerce/view/validation.php';
    }
}

private function showAction()
{
                //no id => redirect home
    if (array_key_exists('id', $_GET)) {
        $iId = intval($_GET['id']);
        $email = $_GET['email'];


        $oProduct = ProductManager::get($iId);
        $oUser = UserManager::getFromEmail($email);
        $oComment = CommentManager::getQueuedComment($oProduct, $oUser);



                // product not found => redirect home
        if (null === $oProduct) {
            $this->homeAction();
            return;
        } else {
            $aQueuedComment = CommentManager::getQueuedComment($oProduct, $oUser);
            require ROOT . 'src/ecommerce/view/validationoneproduct.php';
        }
    } else {
        $aQueuedComment = CommentManager::getQueuedComment();
        require ROOT . 'src/ecommerce/view/validationoneproduct.php';
    }
}

private function removeAction()
{

    $iId = intval($_GET['id']);
    $email = $_GET['email'];

    $oProduct = ProductManager::get($iId);
    $oUser = UserManager::getFromEmail($email);
    $oComment = CommentManager::get($oProduct, $oUser);
    $oComment = CommentManager::remove($oProduct, $oUser);

} 

private function validateAction()
{
    $iId = intval($_GET['id']);
    $email = $_GET['email'];

    $oProduct = ProductManager::get($iId);
    $oUser = UserManager::getFromEmail($email);
    $oComment = CommentManager::get($oProduct, $oUser);
    $oComment = CommentManager::validate($oProduct, $oUser);
}
}