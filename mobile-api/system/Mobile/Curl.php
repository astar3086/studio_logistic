<?php

    Class Curl{

        public $CURLOPT_USERAGENT;
        public $CURLOPT_URL;
        public $CURLOPT_POSTFIELDS;
        public $CURLOPT_HTTPHEADER;


        function __construct(){

            // json encode data
            $this->CURLOPT_USERAGENT = "Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.9.168 Version/11.51";
            $this->CURLOPT_URL = Settings::$server . Config::$route;

            $this->CURLOPT_HTTPHEADER = array(
                /*"Content-Type: application/json",*/
                /*"Content-Type: application/x-www-form-urlencoded",*/
                "Accept: application/json, text/javascript, */*; q=0.01",
                "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
                "Keep-Alive: 115",
                "Connection: keep-alive",
                "X-Requested-With: XMLHttpRequest",
                "Accept-Encoding: gzip, deflate",
                /*"Referer: http://ironworld-pro.carswar.com"*/
                //"Cache-Control: no-cache",
                //"Content-length: ".strlen($data)
            );
        }

        public function setData( $params )
        {
            $this->CURLOPT_POSTFIELDS = $params['data'];
        }

        public function send()
        {
            // set up the curl resource
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->CURLOPT_URL );
            curl_setopt($ch, CURLOPT_USERAGENT, $this->CURLOPT_USERAGENT );
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->CURLOPT_POSTFIELDS);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            //curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->CURLOPT_HTTPHEADER );

            $output = curl_exec($ch);

            if($output === FALSE)
            {
                die( curl_error($ch) );
            }

            $info = curl_getinfo($ch);

            curl_close($ch);
            return $output;
        }


    }

?>