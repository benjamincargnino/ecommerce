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

    class LoginController
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
				$this->actionHome();
			}
			require ROOT . 'inc/site.footer.inc.php';
     
        }
		
		private function homeAction()
        {
            $aCategories = CategoryManager::getAll();
            $aProducts = ProductManager::getRandom(4,1);
            require ROOT . 'src/ecommerce/view/home.php';		
        }
		
        private function subscriptionAction()
        {
            $oUser = new User();
            $oUser->setEmail($_POST['email']);
            $oUser->setPassword($_POST['password']);
            $oUser->setAddress($_POST['address']);
            $oUser->setName($_POST['name']);
            $oUser->setFirstname($_POST['firstname']);
            $oUser->setCp($_POST['cp']);
            $oUser->setCity($_POST['city']);

            if (UserManager::subscribe($oUser)) {
                echo 'Inscription ok!';
                $_SESSION['email'] = $oUser->getEmail();
                $this->homeAction();
            } else {
                $bSubscribeError = true;
                require ROOT . 'src/ecommerce/view/login/login.php';
            }
        }

        private function connectionAction()
        {
            $oUser = new User();
            $oUser->setEmail($_POST['email']);
            $oUser->setPassword($_POST['password']);
	
            if (UserManager::connect($oUser)) {
                //header('location: index.php');
				header('location: index.php');
            } else {
                $bConnectError = true;
                require ROOT . 'src/ecommerce/view/login/login.php';
            }
        }

        private function logoutAction()
        {
            UserManager::logout(UserManager::getCurrent());
			$this->homeAction();
            //header("location: index.php");
        }

        private function loginAction()
        {
            if (array_key_exists('subscribe', $_POST)) {
                $this->performSubscription();
            } elseif (array_key_exists('connect', $_POST)) {
                $this->performConnection();
            } else {
                $bConnectError = false;
                $bSubscribeError = false;
                require ROOT . 'src/ecommerce/view/login/login.php';
            }
        }


    }
