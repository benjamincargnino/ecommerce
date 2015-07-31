<?php

namespace ecommerce\model\dao;

use ecommerce\model\Category;

    /**
     * Class CategoryManager.
     * Manage all category operations.
     *
     * @package ecommerce\model\dao
     */
    class CategoryManager
    {
        /**
         * Convert a category array into a category object.
         *
         * @param array $aCategory category.
         *
         * @return Category converted object.
         */
        private static function convertToObject($aCategory)
        {
            $oCategory = new Category();
            $oCategory->setId(intval($aCategory['id']));
            $oCategory->setName($aCategory['name']);
            $oCategory->setDescription($aCategory['description']);
            $oCategory->setImage($aCategory['image']);
            return $oCategory;
        }

        /**
         * Get $iLimit products from the categories from product id.
         *
         * @param int $iProductId product id
         * @param int      $iLimit    limit to get
         *
         * @return array(Category) all categories of product id.
         */
        public static function getFromProductId($iProductId)
        {
            $sQuery = 'select * from category c, product_category pc ';
            $sQuery .= ' where pc.category_id = c.id';
            $sQuery .= ' and pc.product_id = ' . $iProductId;
            $aCategories = array();
            foreach (DBOperation::getAll($sQuery) as $aCategory) {
                $aCategories[] = self::convertToObject($aCategory);
            }
            return $aCategories;
        }

        /**
         * Get a category from its id.
         *
         * @param int $iId category id.
         *
         * @return Category matched category, null if not found
         */
        public static function get($iId)
        {
            $sQuery = 'select * from category where id = ' . $iId . ' limit 1';
            $aCategoryRow = DBOperation::getOne($sQuery);
            $oCategory = null;
            if (false !== $aCategoryRow) {
                $oCategory = self::convertToObject($aCategoryRow);
            }
            return $oCategory;
        }

        /**
         * Get all categories.
         *
         * @return array(Category) all categories.
         */
        public static function getAll()
        {
            $sQuery = 'select * from category';
            $aCategories = array();
            foreach (DBOperation::getAll($sQuery) as $aCategory) {
                $aCategories[] = self::convertToObject($aCategory);
            }
            return $aCategories;
        }

        public static function create(Category $oCategory)
        {
            $sName = addslashes($oCategory->getName());
            $sDescription = addslashes($oCategory->getDescription());
            $sImage = addslashes($oCategory->getImage());

            $sQuery = 'insert into category(name,description,image) values(';
                $sQuery .= "'$sName','$sDescription','$sImage'";
                $sQuery .= ')';

$bSuccess = DBOperation::exec($sQuery);
if (!$bSuccess) {
    return null;
}

//             //  get last id
// $iCategory = DBOperation::getLastId();

// return $iCategoryId;
}

public static function update(Category $oCategory)
{
    $sName = addslashes($oCategory->getName());
    $sDescription = addslashes($oCategory->getDescription());
    $sImage = addslashes($oCategory->getImage());
            //  get product id
    $iCategoryId = $oCategory->getId();

    $sQuery = "update category ";
    $sQuery .= "set name='$sName',description='$sDescription',image='$sImage'";
    $sQuery .= " where id = $iCategoryId";

    $bSuccess = DBOperation::exec($sQuery);
    if (!$bSuccess) {
        return false;
    }

    return true;
}

public static function remove($iId)
{

    $sQuery = " DELETE FROM category ";
    $sQuery .= " WHERE id = " . $iId;
    $iRetExec = DBOperation::exec($sQuery);
    if(null !== $sLastSqlError = DBOperation::getLastSqlError()){
        throw new \Exception($sLastSqlError);
    }
}

public static function getNumberProducts()
{
    $sQuery =  " SELECT category.id, category.name, category.description, COUNT( product_id ) AS numberproducts ";
    $sQuery .= " FROM category INNER JOIN product_category ON category.id = product_category.category_id" ;
    $sQuery .= " GROUP BY category.id, category.name, category.description";
    $aCategories = array();
    foreach (DBOperation::getAll($sQuery) as $aCategory) {
        $aCategories[] = $aCategory;
    }
    return $aCategories;
}
}