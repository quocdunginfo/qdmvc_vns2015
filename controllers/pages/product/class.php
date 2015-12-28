<?php
/**
 * Created by PhpStorm.
 * User: quocd_000
 * Date: 05/03/2015
 * Time: 11:30 PM
 */
Qdmvc::loadPage('root');

class Qdmvc_Page_Product_Card extends Qdmvc_Page_Root
{
    protected static $fields_show = null;

    protected static function initFields()
    {
        return array(
            'General' => array(
                'Type' => 'Group',
                'Order' => 10,
                'Fields' => array(
                    'id' => array(
                        'Order' => 10,
                        'ReadOnly' => false
                    ),
                    'struct_lv_1' => array(
                        'Order' => 20,
                    ),
                    'name' => array(
                        'Order' => 30,
                    ),
                    'product_cat_id' => array(
                        'Order' => 40,
                    ),
                    '_product_cat_name' => array(
                        'Order' => 50,
                    ),
                    'price' => array(
                        'Order' => 100,
                    ),
                    'active' => array(
                        'Order' => 130,
                    ),
                    /*
                    'stock_status' => array(
                        'Order' => 140,
                    ),
                    */
                    'dtdat' => array(
                        'Order' => 400,
                    ),
                    'dtxaydung' => array(
                        'Order' => 500,
                    ),
                    'dtsudung' => array(
                        'Order' => 600,
                    ),
                    'phaply' => array(
                        'Order' => 800,
                    ),
                )
            ),
            'Tab1' => array(
                'Type' => 'Group',
                'Order' => 20,
                'Name' => array(
                    'vi-VN' => 'Thông tin khác',
                    'en-US' => 'Sub info'
                ),
                'Fields' => array(
                    'avatar' => array(
                        'Order' => 100,
                    ),
                    '_avatar_preview' => array(
                        'Order' => 200,
                    ),
                    'description' => array(
                        'Order' => 300,
                    ),
                    'thongtinlh' => array(
                        'Order' => 400,
                    ),
                    'ggm_embeded' => array(
                        'Order' => 500,
                    ),
                    'date_modified' => array(
                        'Order' => 600,
                    ),
                )
            ),
            'Tab2' => array(
                'Type' => 'Group',
                'Order' => 30,
                'Name' => array(
                    'vi-VN' => 'SEO',
                    'en-US' => 'SEO'
                ),
                'Fields' => array(
                    '_seo_title_preview' => array(
                        'Order' => 10,
                    ),
                    '_seo_description_preview' => array(
                        'Order' => 20,
                    ),
                )
            )
        );
    }

    protected static function getViewClass()
    {
        return 'Qdmvc_View_Product_Card';
    }


    public static function getPage()
    {
        return 'product';
    }
}