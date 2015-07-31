<?php
    /**
     * Created by PhpStorm.
     * User: Yoann
     * Date: 10/07/14
     * Time: 10:12
     */

    namespace ecommerce\model;


    class Order
    {

        private $id;
        private $email;
        private $date;
        private $total;


        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $sEmail
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $sAddress
         */
        public function setDate($date)
        {
            $this->date = $date;
        }

        /**
         * @return mixed
         */
        public function getDate()
        {
            return $this->date;
        }

        /**
         * @param mixed $sEmail
         */
        public function setTotal($total)
        {
            $this->total = $total;
        }

        /**
         * @return mixed
         */
        public function getTotal()
        {
            return $this->total;
        }

        public function getTotalTTC()
        {
            return ($this->total)*1.2;
        }
    }