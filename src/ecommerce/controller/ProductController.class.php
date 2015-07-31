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

class ProductController
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
    $aProducts = ProductManager::getRandom(4,1);
    require ROOT . 'src/ecommerce/view/home.php';
}

private function showAction()
{
            // no id => redirect home
    if (!array_key_exists('id', $_GET)) {
        $this->homeAction();
        return;
    }
    $iId = intval($_GET['id']);

    $oProduct = ProductManager::get($iId);
            // product not found => redirect home
    if (null === $oProduct) {
        $this->homeAction();
        return;
    } else {
        $aCategories = CategoryManager::getFromProductId($iId);
        $aComments = CommentManager::getAllFromProduct($oProduct);
        $aSimilarProducts = ProductManager::getRandom(4,1);
        require ROOT . 'src/ecommerce/view/product/show.php';
    }
}

private function editAction()
{
            // no id => redirect home
    if (!array_key_exists('id', $_GET)) {
        $oProduct = new Product();
    } else {
        $iId = intval($_GET['id']);
        $oProduct = ProductManager::get($iId);
    }

          //  if (array_key_exists('addProduct', $_POST)) {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $oProduct = new Product();
        $oProduct->setName($_POST['name']);
        $oProduct->setPrice($_POST['price']);
        $oProduct->setDescription($_POST['description']);

        if (array_key_exists('categories', $_POST)) {
            foreach ($_POST['categories'] as $iCategoryId) {
                $oProduct->addCategory(CategoryManager::get($iCategoryId));
            }
        }
        if (array_key_exists('product-id', $_POST)) {
                    // retourne Id du nouveau produit. Sinon null
            $iProductId = $_POST['product-id'];
            $oProduct->setId($iProductId );
            ProductManager::update($oProduct);
        }else{
                    // retourne Id du nouveau produit créé. Sinon null
            $iProductId = ProductManager::create($oProduct);
                    // Compléter l'objet par l'id du produit créé
            $oProduct->setId($iProductId);
        }
        
        if(!array_key_exists('image', $_POST))
        {
            $temp = explode(".", $_FILES["image"]["name"]);
            $ext = $temp[count($temp) - 1];
            $newfilename = "images/product/" . $iProductId . '.' . $ext  ;
            $uploadfile =  ROOT .$newfilename;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

            $oProduct->setImage($newfilename);
            ProductManager::update($oProduct);
        }

        $aComments = CommentManager::getAllFromProduct($oProduct);
        $aSimilarProducts = ProductManager::getRandom(5,1);
        $aCategories = CategoryManager::getAll();
        require ROOT . 'src/ecommerce/view/product/show.php';

    }else{
        if (null === $oProduct) {
            $this->homeAction();
            return;
        }

        $aSimilarProducts = ProductManager::getRandom(5,1);
        $aCategories = CategoryManager::getAll();

        require ROOT . 'src/ecommerce/view/product/edit.php';
    }


}

private function cartAction()
{
    if (array_key_exists('remove', $_POST)) {
        $oCartProduct = new CartProduct();
        $oCartProduct->setId(intval($_POST['product']));
        CartManager::remove($oCartProduct);
    } elseif (array_key_exists('edit', $_POST)) {
        $oCartProduct = new CartProduct();
        $oCartProduct->setId(intval($_POST['product']));
        $oCartProduct->setQuantity(intval($_POST['quantity']));
        CartManager::update($oCartProduct);
    }

    $aCart = CartManager::getAll();
    $fTotal = number_format(CartManager::getTotal(), 2);
    require ROOT . 'src/ecommerce/view/cart/cart.php';
}

private function confirmationAction()
{
   {
    if (array_key_exists('remove', $_POST)) {
        $oCartProduct = new CartProduct();
        $oCartProduct->setId(intval($_POST['product']));
        CartManager::remove($oCartProduct);
    } elseif (array_key_exists('edit', $_POST)) {
        $oCartProduct = new CartProduct();
        $oCartProduct->setId(intval($_POST['product']));
        $oCartProduct->setQuantity(intval($_POST['quantity']));
        CartManager::update($oCartProduct);
    }

    $oUser = UserManager::getCurrent();
    $aCart = CartManager::getAll();
    $fTotal = number_format(CartManager::getTotal(), 2);
    $tTotal = number_format(((CartManager::getTotal()*0.2) + CartManager::getTotal()), 2);
    require ROOT . 'src/ecommerce/view/confirmation.php';
}
} 

private function handleAccount()
{
    $oCurrentOrder = OrderManager::getCurrent(UserManager::getCurrent());
    $aOldOrders = OrderManager::getAll(UserManager::getCurrent());
    require ROOT . 'src/ecommerce/view/account.php';
}

public function paiementvalideAction()
{
    $bSuccess = CartManager::save(CartManager::getAll(), UserManager::getCurrent());

    if ($bSuccess) {
        CartManager::clean();
    }
    require ROOT . 'src/ecommerce/view/accepted.php';
}

public function paiementannuleAction()
{
    require ROOT . 'src/ecommerce/view/refused.php';
}

public function submitorderAction()
{
    $result = rand(0, 1);
    if($result == 0)
    {
        $this->paiementannuleAction();
    } else {
        $this->paiementvalideAction();
    }
}

private function commentAction()
{
 $name =  $_POST['name'];
 $comment = $_POST['comment'];
 $iMark = $_POST['stars'];

 $productId = $_POST['product-id'];
 $oProduct =  ProductManager::get($productId);
 $oUser = UserManager::getCurrent();

 $oComment = new Comment();
 $oComment->setDate(date('Y-m-d H:i:s'));
 $oComment->setMark($iMark);
 $oComment->setName($name);
 $oComment->setComment($comment);
 $oComment->setProduct($oProduct);
 $oComment->setUser($oUser);

 try{
    $result = CommentManager::create($oComment);
}catch (\Exception $e){
    $result = $e->getMessage();
}
echo $result;
}

private function addtocartAction()
{

    $oCartProduct = new CartProduct();
    $oCartProduct->setId(intval($_POST['product']));
    $oCartProduct->setQuantity(intval($_POST['quantity']));

    CartManager::add($oCartProduct);

}

private function listAction()
{   
    $aProducts = ProductManager::getAll();
    require ROOT . 'src/ecommerce/view/product/list.php';
}

private function removeAction()
{
    $iId = intval($_GET['id']);
    $oProduct = ProductManager::get($iId);
    try{
        $result = ProductManager::remove($iId);
        $aProducts = ProductManager::getAll();
        require ROOT . 'src/ecommerce/view/product/list.php';
    }catch (\Exception $e){
        $result = $e->getMessage();
        echo "Le produit ne peut pas être supprimé car il fait partie d'une commande";
    }
}

private function archiveAction()
{
    $iId = intval($_GET['id']);
    $oProduct = ProductManager::get($iId);
    if($oProduct->getActive() == 1) 
    {
        $result = ProductManager::archive($iId);
    } 
    if($oProduct->getActive() == 0) 
    {
        $result = ProductManager::display($iId);
    }    
    $aProducts = ProductManager::getAll();
    require ROOT . 'src/ecommerce/view/product/list.php';
}

public function orderAction()
{
    $aAllOrders = OrderManager::getOrders();
    require ROOT . 'src/ecommerce/view/allorders.php';
}   

}