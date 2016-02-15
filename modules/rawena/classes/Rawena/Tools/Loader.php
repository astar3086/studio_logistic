<?php
/**
 * Created by PhpStorm.
 * User: Desktop
 * Date: 20.02.14
 * Time: 20:04
 */

namespace Rawena\Tools;


class Loader {
    public function __invoke($class){

        if(stripos($class,'rawena')){
            if($file = $this->transform(str_replace('\\',DIRECTORY_SEPARATOR,$class))){
                require_once $file;
            }
        } else {
            return false;
        }

    }
    public static function filter(Route $route, $params, Request $request){
        if(stripos($params['directory'],'rawena') !== false){
            $params['controller'] = str_replace('_','\\',$params['controller']);
            return $params;
        } else {
            return FALSE;
        }

    }
    public function transform($class){
        if(stripos($class,'controller') !== false)
            return \Kohana::find_file('controller',$class);
        if(stripos($class,'model') !== false)
            return \Kohana::find_file('model',$class);
        return false;
    }
} 