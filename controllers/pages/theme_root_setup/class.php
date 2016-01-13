<?php
/**
 * Created by PhpStorm.
 * User: quocd_000
 * Date: 05/03/2015
 * Time: 11:36 PM
 */
Qdmvc::loadPage('root_setup');

class Qdmvc_Page_TRootSetup extends Qdmvc_Page_RootSetup
{

    protected static function getViewClass()
    {
        return 'Qdmvc_View_TRootSetup';
    }

    public static function getPage()
    {
        return 'theme_root_setup';
    }

    protected static function initFields()
    {
        return array(
            'Tab3' => array(
                'Type' => 'Group',
                'Order' => 30,
                'Name' => array(
                    'vi-VN' => 'SEO',
                    'en-US' => 'SEO'
                ),
                'Fields' => array(
                    'seo_title_struct' => array(
                        'Order' => 10,
                    ),
                    'seo_title_struct_2' => array(
                        'Order' => 20,
                    ),
                    'seo_description_struct' => array(
                        'Order' => 30,
                    ),
                    'seo_keywords_struct' => array(
                        'Order' => 40,
                    ),
                )
            ),
        );
    }

}