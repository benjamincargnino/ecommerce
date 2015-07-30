<?php

namespace ecommerce\model\dao;

use ecommerce\model\User;
use ecommerce\model\Order;

    /**
     * Class UserManager.
     * Manage all User operations.
     *
     * @package ecommerce\model\dao
     */
    class OrderManager
    {
        private static function convertToObject($aOrder)
        {
            $oOrder = new Order();
            $oOrder->setId($aOrder['id']);
            $oOrder->setEmail($aOrder['user_email']);
            $oOrder->setDate($aOrder['date']);
            $oOrder->setTotal($aOrder['total']);
            return $oOrder;
        }

        public static function getAllOrders($oUser)
        {
            $sQuery = " select * from orders ";
            $sQuery .= " WHERE user_email = '" . $oUser->getEmail() . "'";
            $sQuery .= " ORDER BY date DESC ";
            $aAllOrders = [];
            foreach (DBOperation::getAll($sQuery) as $aOrder) {
                $aAllOrders[] = self::convertToObject($aOrder);
            }
            return $aAllOrders;
        }
    }

