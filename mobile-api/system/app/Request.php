<?php

    Class Request{

        public static $request = [];
        function __construct(){}

        public static function setRequest()
        {
            Request::$request['post'] =  $_POST;
            Request::$request['get']  =  $_GET;
        }

        public static function get( $type, $key )
        {
            if ( Request::$request[ $type ][ $key ] )
            {
                return Request::$request[ $type ][ $key ];
            }
        }


    }

?>