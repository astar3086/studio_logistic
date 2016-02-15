<?php

    Class Response{

        public static $request = [];

        function __construct(){

        }

        public static function setContent()
        {
            Request::$request['post'] = parse_str( $_POST );
            Request::$request['get']  = parse_str( $_GET );
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