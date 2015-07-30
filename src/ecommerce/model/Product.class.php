<?php

    namespace ecommerce\model;


    class Product
    {
        private $iId;
        private $sName;
        private $sDescription;
        private $sImage;
        private $fPrice;
        private $aCategories = array();
        private $iRating;
        private $iActive;
        

        /**
         * @param mixed $fPrice
         */
        public function setPrice($fPrice)
        {
            $this->fPrice = floatval(number_format($fPrice, 2));
        }

        /**
         * @return mixed
         */
        public function getPrice()
        {
            return number_format($this->fPrice, 2);
        }

        public function getPriceTTC()
        {
            return number_format((($this->getPrice()*0.2)+$this->getPrice()), 2);
        }

        /**
         * @param mixed $iId
         */
        public function setId($iId)
        {
            $this->iId = $iId;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->iId;
        }

        /**
         * @param mixed $sDescription
         */
        public function setDescription($sDescription)
        {
            $this->sDescription = $sDescription;
        }

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->sDescription;
        }

        public function getShortDescription($limit)
        {
            return substr($this->getDescription(), 0, $limit) . '...';
        }

        /**
         * @param mixed $sImage
         */
        public function setImage($sImage)
        {
            $this->sImage = $sImage;
        }

        /**
         * @return mixed
         */
        public function getImage()
        {
            // handle images
            if ('' === $this->sImage || !is_file(ROOT . $this->sImage)) {
                $this->sImage = 'images/product-not-found.png';
            }
            return $this->sImage;
        }

        /**
         * @param mixed $sName
         */
        public function setName($sName)
        {
            $this->sName =  $sName;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->sName;
        }

        public function addCategory(Category $oCategory)
        {
            $this->aCategories[] = $oCategory;
        }

        public function getCategories()
        {
            return $this->aCategories;
        }

        public function getUrl()
        {
            return 'index.php?page=product&action=show&id=' . $this->getId();
        }

        /**
         * @param mixed $iRating
         */
        public function setRating($iRating)
        {
            $this->iRating = $iRating;
        }

        /**
         * @return mixed
         */
        public function getRating()
        {
            return $this->iRating;
        }

        public function setActive($iActive)
        {
            $this->iActive = $iActive;
        }

        /**
         * @return mixed
         */
        public function getActive()
        {
            return $this->iActive;
        }

    }