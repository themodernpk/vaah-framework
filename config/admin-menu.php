<?php
add_action('admin_menu', 'vaah_admin_menu');

//------------------------------------------------------------------------
function vaah_admin_menu() {

    $list = \Vaah\Routes::backEndRoutes();

    foreach ($list as $item)
    {
        add_menu_page($item['page_title'], //page title
                      $item['menu_title'], //menu title
                      $item['capabilities'], //capabilities
                      $item['menu_slug'], //menu slug
                        function() use ($item){
                            return call_user_func($item['callback']);
                        } //function
        );

    }




}
//------------------------------------------------------------------------

//------------------------------------------------------------------------
//------------------------------------------------------------------------
//------------------------------------------------------------------------
//------------------------------------------------------------------------