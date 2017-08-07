<?php

namespace Vaah\Libraries;

use Illuminate\Http\Request;
use Illuminate\View\FileViewFinder;
use Illuminate\Filesystem\Filesystem as Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container as Container;
use Illuminate\View\Factory;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\View as View;


class VaahHelper
{

    //------------------------------------------------------
    public static function ViewLoader($viewPath = false, $data = array(), $view=null)
    {

        $viewPath = __DIR__.'/../views'.$viewPath;

        // this path needs to be array
        $FileViewFinder = new FileViewFinder(
            new Filesystem,
            array($viewPath)
        );

        // use blade instead of phpengine
        // pass in filesystem object and cache path
        $compiler = new BladeCompiler(new Filesystem(), __DIR__.'/../../storage/views');
        $BladeEngine = new CompilerEngine($compiler);

        // create a dispatcher
        $dispatcher = new Dispatcher(new Container);

        // build the factory
        $factory = new Factory(
            new EngineResolver,
            $FileViewFinder,
            $dispatcher
        );

        // this path needs to be string
        $viewObj = new View(
            $factory,
            $BladeEngine,
            $view,
            $viewPath,
            $data
        );

        return $viewObj;

    }
    //------------------------------------------------------
    public static function Inputs()
    {
        return Request::capture()->all();
    }
    //------------------------------------------------------
    public static function errorsToArray($errors)
    {
        $errors = $errors;
        $error = array();
        foreach ($errors as $error_list) {
            foreach ($error_list as $item) {
                $error[] = $item;
            }
        }
        return $error;
    }
    //------------------------------------------------------
    public static function validate()
    {
        $trans = new Symfony\Component\Translation\Translator($locale = 'en');
        $validator = new Illuminate\Validation\Factory($trans);
    }
    //------------------------------------------------------
    //------------------------------------------------------
    //------------------------------------------------------

}