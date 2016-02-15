<?php

    Class Settings{

        public static $server = 'http://places.carswar.com/';
        public static $layout = 'frame.php';

        public static $testing_data;
        public static $response_data;
        public static $mobile_mode;

        public static $current_user =  [];
        public static $routing_data = [];
        public static $system =  [];
        public static $render_path =  [];

        function __construct(){}

        public static function init()
        {

            self::$current_user =  [
                'token' => '0eaf1518834283feeca946f560f91dbc'
            ];

            self::$routing_data = [
                'controller' => [
                    'Auth' => [
                        'uloginAuthAjax' => 'Social Links Registration',
                        'register' => 'Registration',
                        'login' => 'Login',
                    ],

                    'portfolio' => [
                        'saveData' => 'Save Portfolio',
                    ],

                    '' => [
                        'mobile.php' => 'Get Markers',
                    ],

                    'chat' => [
                        'addMessage' => 'Send message',
                        'newHistory' => 'Get New Messages',
                        'fullHistory' => 'All Chat Messages',
                    ],

                    'map' => [
                        'show' => 'Show Coordinates',
                        'search' => 'Search Map',
                    ],

                ],
            ];

            self::$testing_data = [
                'Auth/register' => array(
                    "email" => "star2@star2.com",
                    "password" => "111",
                    "gender" => "1",
                    "first_name" => "AMAZON",
                    "last_name" => "COMAND",
                    "birthday" => "2003/11/04"
                ),

                'Auth/uloginAuthAjax' => array(
                    "email" => "social2@mail.ru",
                    "password" => "111",
                    "gender" => "1",
                    "first_name" => "AMAZON",
                    "last_name" => "COMAND",
                    "birthday" => "2008/11/04",
                    "network" => "vkontakte",
                    "profile" => "vk.com/vasia",
                    "identity" => "123454",
                    "avatar_url" => "2003/11/04",
                ),

                'Auth/login' => array(
                    "email" => "social2@mail.ru",
                    "password" => "111",
                ),

                'chat/addMessage' => array(
                    "token" => "0eaf1518834283feeca946f560f91dbc", //user 11
                    "receiver_id" => "10",
                    "message" => "Hellow User",
                ),

                'chat/newHistory' => array(
                    "token" => "7906bfd673e5891ca2fbf769d8ee0d4a",//user 10
                    "receiver_id" => "11",
                ),

                'chat/fullHistory' => array(
                    "token" => "7906bfd673e5891ca2fbf769d8ee0d4a",//user 10
                    "receiver_id" => "11",
                    'limit' => 5,
                    'offset' => 0,
                ),

                'map/show' => array(
                    "type_id" => "1",
                    "distance" => "100",
                    "center_lat" => "50.46974272",
                    "center_lng" => "30.60722351",
                    "limit" => "100",
                ),

                'mobile.php' => array(
                    "key" => "country_group",
                    "groups" => '["Seaport"]',
                ),

                'map/search' => array(
                    "search" => "life",
                    "limit" => "100",
                ),

                'portfolio/saveData' => array(
                    "token" => "0eaf1518834283feeca946f560f91dbc",
                    'avatar_url' => '@' . API_CONTENT . 'images'. DS . 'bael.jpg',
                ),

            ];

            self::$response_data = [
                'Auth/register' => array(
                    'status' => '',
                    'error' => ''
                ),

                'chat/addMessage' => array(
                    'User' => 'Sender ID 11',
                    'status' => '',
                    'error' => ''
                ),

                'chat/newHistory' => array(
                    'User' => 'Receiver ID 10',
                    'status' => '',
                    'error' => ''
                ),
            ];

            self::$render_path =  [
                'view' => 'view_mobile',
                'send' => 'view_response',
            ];

        }

    }

?>