<?php
/**
 * Created by PhpStorm.
 * User: quocd_000
 * Date: 05/03/2015
 * Time: 11:36 PM
 */
Qdmvc::loadPage('root');

class Qdmvc_Page_ProductCat_Card extends Qdmvc_Page_Root
{
    protected static function getViewClass()
    {
        return 'Qdmvc_View_ProductCat_Card';
    }

    public static function getPage()
    {
        return 'product_cat_card';
    }

    protected static function initFields()
    {
        return array(
            'General' => array(
                'Type' => 'Group',
                'Fields' => array(
                    'id' => array(
                        'Order' => 100,
                        'ReadOnly' => false,
                    ),
                    'type' => array(
                        'Order' => 200,
                        'Hidden' => true
                    ),
                    'level' => array(
                        'Order' => 900,
                    ),
                    'name' => array(
                        'Order' => 1000,
                    ),
                    'order' => array(
                        'Order' => 1400,
                    ),
                    'active' => array(
                        'Order' => 1500,
                    ),
                )
            ),

        );
    }
}