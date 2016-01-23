<?php

/**
 * Created by PhpStorm.
 * User: quocd_000
 * Date: 03/05/2015
 * Time: 9:48 AM
 */
class Qdmvc_Page_IndexCustomMenu
{
    public static function getIndex()
    {
        return static::getMenu();
    }
    private static function getMenuFolder(){

        return array(
            /*Folder*/
            'folder10' => array(
                'ParentId' => -1,
                'PageType' => 'Folder',
                'Active' => true,
                'Caption' => array(
                    'vi-VN' => 'Bất động sản',
                    'en-US' => 'Product'
                )
            ),
            'folder20' => array(
                'ParentId' => -1,
                'PageType' => 'Folder',
                'Active' => false,
                'Caption' => array(
                    'vi-VN' => 'Vị trí - BDS',
                    'en-US' => 'Product Category'
                )
            ),
        );
    }
    private static function getMenuToOther(){
        return array(
            'setup_other' => array(
                'ParentId' => 'folder50',
                'Active' => true,
                'PageType' => 'Card',
                'Class' => 'Qdmvc_Page_SetupOther',
                'Caption' => array(
                    'en-US' => 'Other Setup',
                    'vi-VN' => 'Cấu hình khác',
                ),
                'Model' => 'QdSetupOther',
                'DataPort' => 'setup_other_port'
            ),
            'theme_root_setup' => array(
                'ParentId' => 'folder50',
                'Active' => true,
                'PageType' => 'Card',
                'Class' => 'Qdmvc_Page_TRootSetup',
                'Caption' => array(
                    'en-US' => 'Theme Root Setup',
                    'vi-VN' => 'Theme Root Setup',
                ),
                'Model' => 'QdTRootSetup',
                'DataPort' => 'theme/root_setup_port'
            ),
            'theme_root_setup_mobile' => array(
                'ParentId' => 'theme_root_setup',
                'Active' => true,
                'PageType' => 'Card',
                'Class' => 'Qdmvc_Page_TRootSetupMobile',
                'Caption' => array(
                    'en-US' => 'Theme Root Setup (Mobile)',
                    'vi-VN' => 'Theme Root Setup (Mobile)',
                ),
                'Model' => 'QdTRootSetupMobile',
                'DataPort' => 'theme/root_setup_mobile_port'
            ),
        );
    }
    private static function getMenuBDS(){
        return array(
            'product' => array(
                'ParentId' => 'folder10',
                'Active' => true,
                'PageType' => 'Card',
                'Class' => 'Qdmvc_Page_Product_Card',
                'Caption' => array(
                    'en-US' => 'Product (All)',
                    'vi-VN' => 'Bất động sản (Tất cả)',
                ),
                'Model' => 'QdProduct',
                'DataPort' => 'product_port',
                'PageList' => 'product_list'
            ),
            'product_list' => array(
                'ParentId' => -1,
                'Active' => false,
                'PageType' => 'List',
                'Class' => 'Qdmvc_Page_Product_List',
                'Caption' => array(
                    'en-US' => 'Product List',
                    'vi-VN' => 'Product List'
                ),
                'Model' => 'QdProduct',
                'DataPort' => 'product_port'
            ),
        );
    }
    private static function getMenuLoaiBDS(){
        return array(
            'product_cat_card' => array(
                'ParentId' => 'folder10',
                'Active' => true,
                'PageType' => 'Card',
                'Class' => 'Qdmvc_Page_ProductCat_Card',
                'Caption' => array(
                    'en-US' => 'Product Category (All)',
                    'vi-VN' => 'Vị trí BDS (Tất cả)',
                ),
                'Model' => 'QdProductCat',
                'DataPort' => 'product_cat_port',
                'PageList' => 'product_cat_list'
            ),
            'product_cat_list' => array(
                'ParentId' => -1,
                'Active' => false,
                'PageType' => 'List',
                'Class' => 'Qdmvc_Page_ProductCat_List',
                'Caption' => array(
                    'en-US' => 'Product Cat List',
                    'vi-VN' => 'Product Cat List',
                ),
                'Model' => 'QdProductCat',
                'DataPort' => 'product_cat_port'
            ),
            'product' => array(
                'ParentId' => 'folder10',
                'Active' => true,
                'PageType' => 'Card',
                'Class' => 'Qdmvc_Page_Product_Card',
                'Caption' => array(
                    'en-US' => 'Product (All)',
                    'vi-VN' => 'Bất động sản (Tất cả)',
                ),
                'Model' => 'QdProduct',
                'DataPort' => 'product_port',
                'PageList' => 'product_list'
            ),
            'product_list' => array(
                'ParentId' => -1,
                'Active' => false,
                'PageType' => 'List',
                'Class' => 'Qdmvc_Page_Product_List',
                'Caption' => array(
                    'en-US' => 'Product List',
                    'vi-VN' => 'Product List'
                ),
                'Model' => 'QdProduct',
                'DataPort' => 'product_port'
            ),
        );
    }
    private static function getMenu()
    {
        $obj = array(

        );
        $obj = array_merge($obj, static::getMenuBDS());
        $obj = array_merge($obj, static::getMenuLoaiBDS());
        $obj = array_merge($obj, static::getMenuToOther());
        $obj = array_merge($obj, static::getMenuFolder());
        return $obj;
    }
}