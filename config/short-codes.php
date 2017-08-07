<?php
$list = \Vaah\Routes::frontShortCodes();

foreach ($list as $item)
{
    add_shortcode( $item['shortcode_name'],
        function() use ($item){
            return call_user_func($item['callback']);
        }
    );
}
