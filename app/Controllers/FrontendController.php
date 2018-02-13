<?php

namespace Vaah\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Vaah\Libraries\VaahHelper;
use Valitron\Validator as Validator;



use Vaah\Models\Task;


class FrontendController {

    //------------------------------------------------------
    public function index()
    {


        $response['status'] = 'success';
        $response['data']= [];
        return $response;
    }

    //------------------------------------------------------
    public function taskList()
    {




        $list = Task::orderBy('id', 'DESC')->paginate(3);

        $response['status'] = 'success';
        $response['data']['list']= $list;
        $response['data']['inputs']= VaahHelper::Inputs();

        return $response;
    }
    //------------------------------------------------------
    public function taskCreate()
    {

        $inputs = VaahHelper::Inputs();

        $v = new Validator($inputs);
        $v->rule('required', ['name']);
        if(!$v->validate()) {
            $response['status'] = 'failed';
            $response['errors']= VaahHelper::errorsToArray($v->errors());
            return $response;
        }

        $list = new Task();
        $list->name = $inputs['name'];
        $list->save();

        $response['status'] = 'success';
        $response['data']= $list;
        return $response;
    }
    //------------------------------------------------------
    public function test_short_code()
    {

        $r = VaahHelper::ViewLoader('/frontend/short-codes/test.blade.php', array('testvar' => ' timestamp: '.time()) );
        echo $r->render();




    }
    //------------------------------------------------------
    //------------------------------------------------------
    //------------------------------------------------------
}