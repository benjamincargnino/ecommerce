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

            require ROOT . 'src/ecommerce/view/category/show.php';

        }else{

            if (null === $oCategory) {
                $this->homeAction();
                return;
            }

            $aCategories = CategoryManager::getAll();
            require ROOT . 'src/ecommerce/view/category/edit.php';
        }
    }

    private function listAction()
    {   
        $aCategories = CategoryManager::getAll();
        require ROOT . 'src/ecommerce/view/category/list.php';
    }

    private function removeAction()
    {
        $iId = intval($_GET['id']);
        $oCategory = CategoryManager::get($iId);
        try{
            $result = CategoryManager::remove($iId);
            $aCategories = CategoryManager::getAll();
            require ROOT . 'src/ecommerce/view/category/list.php';
        }catch (\Exception $e){
            $result = $e->getMessage();
            echo "La catégorie ne peux pas être supprimée car elle contient des produits";
        }
    }
}
