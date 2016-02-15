<?php

    Class Engine{

        public static $xrequested;
        public static $director;
        public static $response;
        public static $config;

        public static function init()
        {
            Engine::$director = new Director();

            Engine::$response =  Engine::$director->initResponse();
        }

        public static function view()
        {
            Engine::setHeaders();
            return Engine::$response;
        }

        public static function setHeaders()
        {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            {
                header('Content-type: application/json');
            }
        }


    }

?>