<?php

namespace Vaah\Controllers;


use Vaah\Libraries\VaahHelper as VaahHelper;


class BackendController{

    //------------------------------------------------------
    public function index()
    {
        // create a template
        $r = VaahHelper::ViewLoader('/backend/index.blade.php', array('testvar' => ' timestamp: '.time()) );
        echo $r->render();
    }

    //------------------------------------------------------

    //------------------------------------------------------
    //------------------------------------------------------
    public  function create()
    {



    }
    //------------------------------------------------------
    //------------------------------------------------------
    //------------------------------------------------------
    //------------------------------------------------------
}