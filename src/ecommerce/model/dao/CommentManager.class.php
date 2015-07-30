<?php

namespace ecommerce\model\dao;

use ecommerce\model\Comment;
use ecommerce\model\Product;
use ecommerce\model\User;


    /**
     * Class CommentManager.
     * Manage all Comment operations.
     *
     * @package ecommerce\model\dao
     */
    class CommentManager
    {
        /**
         * Convert a Comment array into a Comment object.
         *
         * @param array $aComment Comment.
         *
         * @return Comment converted object.
         */
        private static function convertToObject($aComment)
        {
            $oComment = new Comment();
            $oComment->setComment($aComment['comment']);
            $oComment->setMark(intval($aComment['mark']));
            $oComment->setDate($aComment['date']);
            $oComment->setName($aComment['name']);

            $oUser = new User();
            $oUser->setEmail($aComment['user_email']);
            $oComment->setUser(UserManager::get($oUser));
            $oComment->setProduct(ProductManager::get($aComment['product_id']));
            return $oComment;
        }

        public static function getAllFromProduct(Product $oProduct, $iLimit = 10)
        {
            $sQuery = 'select * from comment ';
            $sQuery .= ' where product_id = ' . $oProduct->getId();
            $sQuery .= ' and validated = 1';
            $sQuery .= ' limit ' . $iLimit;
            $aComments = array();
            foreach (DBOperation::getAll($sQuery) as $aComment) {
                $aComments[] = self::convertToObject($aComment);
            }

            return $aComments;
        }

        public static function create(Comment $oComment)
        {
            $sQuery = 'insert into comment(product_id,name, user_email,comment,mark,date) values(';
                $sQuery .= "'{$oComment->getProduct()->getId()}', '{$oComment->getName()}','{$oComment->getUser()->getEmail(
                    )}','{$oComment->getComment()}','{$oComment->getMark()}','{$oComment->getDate()}'";
$sQuery .= ')';

$iRetExec = DBOperation::exec($sQuery);
if(null !== $sLastSqlError = DBOperation::getLastSqlError()){
    throw new \Exception($sLastSqlError);
}
}

// public static function get($email)
//         {
//             $sQuery = 'select * from comment where user_email = ' . $email . ' limit 1';
//             $aCommentRow = DBOperation::getOne($sQuery);
//             $oComment = null;
//             if (false !== $aCommentRow) {
//                 $oProduct = self::convertToObject($aCommentRow);
//             }
//             return $oComment;
//         }

public static function getAllComments(Product $oProduct = null)
{
    $sQuery = 'select * from comment ';

    if($oProduct !== null) 
    {
        $sQuery .= ' WHERE product_id = ' . $oProduct->getId();
        $sQuery .= ' AND validated = 0';
    } else {

        $sQuery .= ' WHERE validated = 0';
    }
    $aAllComments = array();
    foreach (DBOperation::getAll($sQuery) as $aComment) {
        $aAllComments[] = self::convertToObject($aComment);
    }
    return $aAllComments;
}

public static function getQueuedComment(Product $oProduct, User $oUser)
{
    $sQuery = "select * from comment ";


    $sQuery .= " WHERE product_id = " . $oProduct->getId();
    $sQuery .= " AND user_email = '" . $oUser->getEmail() . "'";
    $sQuery .= " AND validated = 0";

    $aCommentRow = DBOperation::getOne($sQuery);
    $oComment = null;
    if (false !== $aCommentRow) {
       $oComment = self::convertToObject($aCommentRow);
   }
   return $oComment;
}

public static function get(Product $oProduct, User $oUser)
{
    $sQuery = " select * from comment ";
    $sQuery .= " where product_id = " . $oProduct->getId() . " AND user_email = '" . $oUser->getEmail() . "'";
    $sQuery .= " limit 1";
    $aCommentRow = DBOperation::getOne($sQuery);
    $oComment = null;
    if (false !== $aCommentRow) {
        $oComment = self::convertToObject($aCommentRow);
    }
    return $oComment;
}

public static function remove(Product $oProduct, User $oUser)
{

    $sQuery = " delete from comment ";
    $sQuery .= " WHERE product_id = " . $oProduct->getId();
    $sQuery .= " AND user_email = '" . $oUser->getEmail() . "'";
    $iRetExec = DBOperation::exec($sQuery);
    if(null !== $sLastSqlError = DBOperation::getLastSqlError()){
        throw new \Exception($sLastSqlError);
    }
}

public static function validate(Product $oProduct, User $oUser)
{
    $sQuery = " update comment";
    $sQuery .= " SET validated = 1";
    $sQuery .= " WHERE product_id = " . $oProduct->getId();
    $sQuery .= " AND user_email = '" . $oUser->getEmail() . "'";
    $iRetExec = DBOperation::exec($sQuery);
    if(null !== $sLastSqlError = DBOperation::getLastSqlError()){
        throw new \Exception($sLastSqlError);
    }
}

}