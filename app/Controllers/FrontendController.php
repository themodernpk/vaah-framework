<?php

namespace Vaah\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Vaah\Libraries\VaahHelper;
use Valitron\Validator as Validator;



use Vaah\Models\Task;


class FrontendController {

    //------------------------------------------------------
    public static function index(Request $request)
    {


        $response['status'] = 'success';
        $response['data']= [];
        return $response;
    }

    //------------------------------------------------------
    public static  function taskList()
    {
        $perPage = 2; // results per page
        $columns = ['*']; // (optional, defaults to *) array of columns to retrieve from database
        $pageName = 'page_number';


        $list = Task::orderBy('id', 'DESC')->paginate($perPage, $columns, $pageName);

        $response['status'] = 'success';
        $response['data']['list']= $list;
        $response['data']['inputs']= VaahHelper::Inputs();

        return $response;
    }
    //------------------------------------------------------
    public static  function taskCreate()
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
    public static function test_short_code()
    {


        $perPage = 2; // results per page
        $columns = ['*']; // (optional, defaults to *) array of columns to retrieve from database
        $pageName = 'page_number';


        $list = Task::paginate($perPage, $columns, $pageName);


        $r = VaahHelper::ViewLoader('/frontend/short-codes/test.blade.php',
            array('list' => $list) );

        echo $r->render();

    }
    //------------------------------------------------------
    //------------------------------------------------------
    //------------------------------------------------------
}