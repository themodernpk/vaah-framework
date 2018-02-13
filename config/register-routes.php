<?php

//register restful api for frontend
add_action( 'rest_api_init', 'vaah_routes' );

function vaah_routes()
{

    $list = \Vaah\Routes::frontEndRoutes();
    foreach ($list as $item)
    {
        register_rest_route(
            'vaah',
            $item['route'],
             array(
                     'methods' => $item['method'],
                     'callback' => function() use ($item)
                     {
                         return call_user_func($item['callback']);
                     }
                 )
        );
    }

}