<?php

namespace Vaah;

class Routes
{

    //----------------------------------------------------------------------------------
    public static function backEndRoutes()
    {
        $list = array(

            [
                'page_title'    => 'Vaah Index Page',
                'menu_title'    => 'Vaah',
                'menu_slug'     => 'vaah-index',
                'capabilities'  => 'manage_options',
                'callback'      => '\Vaah\Controllers\BackendController::index',
                'sub_menus'     =>
                    [

                        [
                            'page_title'    => 'Sub Menu 1',
                            'menu_title'    => 'Sub Menu 1',
                            'menu_slug'     => 'sub-menu-1',
                            'capabilities'  => 'manage_options',
                            'callback'      => '\Vaah\Controllers\BackendController::index',
                        ],
                        [
                            'page_title'    => 'Sub Menu 2',
                            'menu_title'    => 'Sub Menu 2',
                            'menu_slug'     => 'sub-menu-2',
                            'capabilities'  => 'manage_options',
                            'callback'      => '\Vaah\Controllers\BackendController::index',
                        ]

                    ]
            ],

            [
                'page_title'     => 'Vaah Edit',
                'menu_title'    =>'Vaah Edit',
                'menu_slug'    =>'vaah-edit',
                'capabilities'    =>'manage_options',
                'callback'  =>'\Vaah\Controllers\BackendController::index'
            ],

        );

        return $list;
    }
    //----------------------------------------------------------------------------------
    /*
     * these are frontend restful url
     * path will be <base-url>/wp-json/vaah/<route-name>
     */
    public static function frontEndRoutes()
    {
        $list = array(

            [   'route'     => '/index',
                'method'    =>'GET',
                'callback'  =>'\Vaah\Controllers\FrontendController::index'
            ],

            [   'route'     => '/task/list',
                'method'    =>'GET, POST',
                'callback'  =>'\Vaah\Controllers\FrontendController::taskList'
            ],

            [   'route'     => '/task/create',
                'method'    =>'GET, POST',
                'callback'  =>'\Vaah\Controllers\FrontendController::taskCreate'
            ],

        );

        return $list;
    }

    //----------------------------------------------------------------------------------
    public static function frontShortCodes()
    {
        $list = array(

            [   'shortcode_name'    => 'TestShortCode',
                'callback'          =>'\Vaah\Controllers\FrontendController::test_short_code'
            ],


        );

        return $list;
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
}

