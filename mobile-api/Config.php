<?php

    Class Config{

        public static $server = '';
        public static $layout = 'frame.php';

        public static $testing_data;
        public static $response_data;
        public static $mobile_mode;

        public static $is_ajax;
        public static $session;
        public static $controller;
        public static $action;
        public static $route;

        public static $current_user =  [];
        public static $routing_data = [];
        public static $system =  [];

        public static $render_path =  [];

        function __construct(){}

        public static function init()
        {

            self::$system =  [
                'design'. DS. 'controller'. DS . 'Builder.php',
                'system'. DS . 'app'. DS . 'Request.php',
                'system'. DS . 'app'. DS . 'Response.php',
                'system'. DS . 'app'. DS . 'Templater.php',
                'system'. DS . 'Feedback'. DS . 'Feedback.php',
                'system'. DS . 'DirectorAbstract.php',
                'system'. DS . 'Mobile'. DS . 'Director.php',
                'system'. DS . 'Mobile'. DS . 'Curl.php',
            ];

        }

        public static function router()
        {

            // System Classes
            Config::init();

            Autoloder::load();

            Request::setRequest();

            // Router Data
            Config::$controller = Request::$request['post']
            ['controller'];

            Config::$action = Request::$request['post']
            ['action'];

            Config::$route = self::$controller. '/' .self::$action;

            Config::$session = [];

            Config::$is_ajax = false;
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            {
                Config::$is_ajax = true;
            }

            // Current User Session
            Config::locateUserSession();

            // API Mode
            if ( !Request::$request['post'] )
            {

                //Default API Mode
                Config::$mobile_mode = 'default';

            } else
            {
                Config::$mobile_mode = Request::$request['post']
                ['mobile'];
            }

            return true;

        }

        // Get User Session
        private static function locateUserSession()
        {

            if ( Request::$request['post']['user'] )
            {

                // Current user
                Config::$current_user =  Request::$request
                                    ['post']['user'];

            } else
            {

                // Set User Data From Session
                if ( $_SESSION['current_user'] )
                {
                    // Current user
                    Config::$current_user = $_SESSION['current_user'];
                }
            }

        }

        // Get Current Router Data
        public static function getData()
        {

            if ( Settings::$testing_data[ self::$route  ] )
            {

                $testing_vals = Settings::$testing_data
                                    [ self::$route  ];

                if ( $_POST['data'] )
                {
                    parse_str( $_POST['data'], $returned );
                }

                foreach ( $testing_vals as $key => $value )
                {
                    if ( $returned[ $key ] ){
                        $testing_vals[$key] =  $returned[ $key ];
                    }
                }

                return $testing_vals;
            }

        }

        // Server Response Data
        public static function getFeedbackData()
        {

            if ( Settings::$response_data[ self::$route  ] )
            {
                return Settings::$response_data[ self::$route  ];
            } else {

                // Default Response
                return  array(
                    'status' => '',
                    'error' => ''
                );
            }
        }

        // Get Data for Current Controller
        private function getPath( $current )
        {
            $paths = explode( DS, $current );

            $controller = $paths[0];
            $action     = $paths[1];
        }
    }

?>