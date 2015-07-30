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
use ecommerce\model\Category;
use ecommerce\model\Product;
use ecommerce\model\User;

class CategoryController
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

    private function homeAction()
    {
        $aCategories = CategoryManager::getAll();
        $aProducts = ProductManager::getRandom(4);
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

        $oCategory = CategoryManager::get($iId);

            // product not found => redirect home
        if (null === $oCategory) {
            $this->homeAction();
            return;
        } else {
            $aProducts = ProductManager::getAllFromCategory($oCategory);
            require ROOT . 'src/ecommerce/view/category/show.php';
    //}
        }
    }

    private function editAction()
    {
            // no id => redirect home
        if (!array_key_exists('id', $_GET)) {
            $oCategory = new Category();
        } else {
            $iId = intval($_GET['id']);
            $oCategory = CategoryManager::get($iId);
        }

          //  if (array_key_exists('addProduct', $_POST)) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $oCategory = new Category();
            $oCategory->setName($_POST['name']);
            $oCategory->setDescription($_POST['description']);

            if (array_key_exists('categories', $_POST)) {
                foreach ($_POST['categories'] as $iCategoryId) {
                    $oCategory->addCategory(CategoryManager::get($iCategoryId));
                }
            }
            if (array_key_exists('category-id', $_POST)) {
                    // retourne Id du nouveau produit. Sinon null
                $iCategoryId = $_POST['category-id'];
                $oCategory->setId($iCategoryId);
                CategoryManager::update($oCategory);
            }else{
                    // retourne Id du nouveau produit créé. Sinon null
                $iCategoryId = CategoryManager::create($oCategory);
                    // Compléter l'objet par l'id du produit créé
                $oCategory->setId($iCategoryId);
            }

            $temp = explode(".", $_FILES["image"]["name"]);
            $ext = $temp[count($temp) - 1];
            $newfilename = "images/category/" . $iCategoryId . '.' . $ext  ;
            $uploadfile =  ROOT .$newfilename;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

            $oCategory->setImage($newfilename);
            CategoryManager::update($oCategory);
            

           // $aCategories = CategoryManager::getAll();

            //$aProducts = ProductManager::getAllFromCategory($oCategory);
            require ROOT . 'src/ecommerce/view/category/show.php';

        }else{


            $aCategories = CategoryManager::getAll();

            require ROOT . 'src/ecommerce/view/category/edit.php';
        }


    }

    private function handleCart()
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
        require ROOT . 'src/ecommerce/view/cart.php';
    }

    private function handleAccount()
    {
        $oCurrentOrder = OrderManager::getCurrent(UserManager::getCurrent());
        $aOldOrders = OrderManager::getAll(UserManager::getCurrent());
        require ROOT . 'src/ecommerce/view/account.php';
    }

    private function handlePopulate()
    {
        if (array_key_exists('addProduct', $_POST)) {
            $oProduct = new Product();
            $oProduct->setName($_POST['name']);
            $oProduct->setPrice($_POST['price']);
            $oProduct->setDescription($_POST['description']);
            foreach ($_POST['categories'] as $iCategoryId) {
                $oProduct->addCategory(CategoryManager::get($iCategoryId));
            }
            $bCreateSuccess = ProductManager::create($oProduct);
        }
        if (array_key_exists('addComments', $_POST)) {
            $oProduct = ProductManager::get($_POST['product']);
            foreach ($_POST['users'] as $oUserEmail) {
                $oUser = new User();
                $oUser->setEmail($oUserEmail);
                $oUser = UserManager::get($oUser);
                $oComment = new Comment();
                $oComment->setDate(date('Y-m-d H:i:s'));
                $oComment->setMark(rand(0, 5));
                $oComment->setComment(
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut quis dui dolor.'
                    );
                $oComment->setProduct($oProduct);
                $oComment->setUser($oUser);

                CommentManager::create($oComment);
            }
        }
        require ROOT . 'src/ecommerce/view/populate.php';
    }

    public function handleSubmitOrder()
    {
        $bSuccess = CartManager::save(CartManager::getAll(), UserManager::getCurrent());

        if ($bSuccess) {
            CartManager::clean();
        }
        $this->homeAction();
    }

    private function addToCart()
    {
        if (array_key_exists('addToCart', $_POST)) {
            $oCartProduct = new CartProduct();
            $oCartProduct->setId(intval($_POST['product']));
            $oCartProduct->setQuantity(intval($_POST['quantity']));
            CartManager::add($oCartProduct);
        }
    }

    private function commentAction()
    {
     $comment = $_POST['comment'];

     $productId = $_POST['product-id'];
     $oProduct =  ProductManager::get($productId);
     $oUser = UserManager::getCurrent();

     $oComment = new Comment();
     $oComment->setDate(date('Y-m-d H:i:s'));
     $oComment->setMark(rand(0, 5));
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
}
