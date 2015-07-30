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
use ecommerce\model\Order;

class AccountController
{

    public function __construct()
    {
     $sAction = 'home';
     if (array_key_exists('action', $_GET)) {
        $sAction = $_GET['action'];
    }

    $sFunction = lcfirst($sAction) . 'Action';


    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Traitement pour une requête AJAX
        $this->$sFunction();
    }else {
        // $this->addToCart();

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
}

private function homeAction()
{
    $aCategories = CategoryManager::getAll();
    $aProducts = ProductManager::getRandom(4);
    require ROOT . 'src/ecommerce/view/home.php';
}

private function addressAction()
{
    $oUser = UserManager::getCurrent();
    if (!$oUser) {
        $this->homeAction();
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $messageError = array();
        if (array_key_exists('firstname', $_POST)) {
            $oUser->setFirstName($_POST['firstname']);
        }else{
            $messageError[] = 'L\'adresse est obligatoire';
        }

        if (array_key_exists('name', $_POST)) {
            $oUser->setName($_POST['name']);
        }else{
            $messageError[] = 'L\'adresse est obligatoire';
        }

        if (array_key_exists('address', $_POST)) {
            $oUser->setAddress($_POST['address']);
        }else{
            $messageError[] = 'L\'adresse est obligatoire';
        }

        if (array_key_exists('cp', $_POST)) {
            $oUser->setCp($_POST['cp']);
        }else{
            $messageError[] = 'Le code postal est obligatoire';
        }

        if (array_key_exists('city', $_POST)) {
            $oUser->setCity($_POST['city']);
        }else{
            $messageError[] = 'La ville est obligatoire';        
        }

        $result = UserManager::updateAddress($oUser);
        $this->homeAction();

    } else {
        require ROOT . 'src/ecommerce/view/account/address.php';
    }
}

private function passwordAction()
{
    $oUser = UserManager::getCurrent();
    if (!$oUser) {
        $this->homeAction();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $messageError = array();

        if(sha1($_POST['currentpassword']) == $oUser->getPassword()) {

            if (array_key_exists('password', $_POST)) {
                $oUser->setPassword($_POST['password']);
            } else {
                $messageError[] = 'Le mot de passe est obligatoire';
            }

            if ($_POST['confirm_password'] == $_POST['password'] ) {

                $result = UserManager::updatePassword($oUser);
                $success = 'Your password has been successfully changed';
                echo '<script type="text/javascript">window.alert("'.$success.'");</script>';
                $this->homeAction();

            } else {

                $message = "Password confirmation doesn't match the new password";
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                require ROOT . 'src/ecommerce/view/account/password.php';
            }

        } else {

            $msg = "Incorrect password";
            echo '<script type="text/javascript">window.alert("'.$msg.'");</script>';
            require ROOT . 'src/ecommerce/view/account/password.php';
        }

    } else {

        require ROOT . 'src/ecommerce/view/account/password.php';
    }
}

    private function myordersAction()
    {
        $oUser = UserManager::getCurrent();
        if (!$oUser) {
            $this->homeAction();
        }

        $aAllOrders = OrderManager::getAllOrders($oUser);
        require ROOT . 'src/ecommerce/view/myorders.php';
    }

    private function detailorderAction()
    {
        $id = intval($_GET['id']);
        $oOrder = ProductManager::getAllFromOrder($id);
        require ROOT . 'src/ecommerce/view/detailorder.php';
    }
}

