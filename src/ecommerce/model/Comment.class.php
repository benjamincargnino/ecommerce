<?php

    namespace ecommerce\model;


    class Comment
    {
        private $oProduct;
        private $oUser;
        private $sComment;
        private $iMark;
        private $dDate;
        private $sName;

        /**
         * @param mixed $dDate
         */
        public function setDate($dDate)
        {
            $this->dDate = $dDate;
        }

        /**
         * @return mixed
         */
        public function getDate()
        {
            return $this->dDate;
        }

        /**
         * @param mixed $iMark
         */
        public function setMark($iMark)
        {
            $this->iMark = $iMark;
        }

        /**
         * @return mixed
         */
        public function getMark()
        {
            return $this->iMark;
        }

        /**
         * @param Product $oProduct
         */
        public function setProduct(Product $oProduct)
        {
            $this->oProduct = $oProduct;
        }

        /**
         * @return Product product
         */
        public function getProduct()
        {
            return $this->oProduct;
        }

        /**
         * @param User $oUser
         */
        public function setUser(User $oUser)
        {
            $this->oUser = $oUser;
        }

        /**
         * @return User user
         */
        public function getUser()
        {
            return $this->oUser;
        }

        public function getUrl()
        {
            return 'index.php?page=comment&action=show&id=' . $this->getUser();
        }

        /**
         * @param mixed $sComment
         */
        public function setComment($sComment)
        {
            $this->sComment = $sComment;
        }

        /**
         * @return mixed
         */
        public function getComment()
        {
            return $this->sComment;
        }

        public function getShortComment($limit)
        {
            return substr($this->getComment(), 0, $limit) . '...';
        }

        public function setName($sName)
        {
            $this->sName = $sName;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->sName;
        }
	
        public function getDateOld()
        {

            $startDate = $this->getDate();
            $endDate = date("Y-m-d H:i:s");

            $date1 = new \DateTime($startDate);
            $date2 = new \DateTime($endDate);
            $interval = $date1->diff($date2);

            return array('years'=>$interval->y, 'months'=>$interval->m, 'days'=>$interval->d);
        }
    }