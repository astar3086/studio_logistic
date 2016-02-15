<?php

    Class DirectorAbstract{
        public $sender;

        // Set Curl
        public function setBuilder( $builder )
        {
            $this->sender = new $builder;
            $this->sender->init();
        }

        public function initResponse()
        {
            return $this->sender->send();
        }


    }

?>