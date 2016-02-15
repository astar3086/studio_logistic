<?php

    Class Director extends DirectorAbstract {
        public $sender;
        public $feedback;

        function __construct()
        {
            $builder = 'Curl';
            $this->setBuilder( $builder );

        }

        // Set Curl
        public function setBuilder( $builder )
        {
            $this->sender = new $builder();
        }

        // Init Controller and View
        public function initResponse()
        {
            switch ( Config::$mobile_mode )
            {
                case 'send':
                    return $this->sendMobile();
                    break;

                default:
                    return $this->viewDefault();
                    break;
            }
        }

        // Mobile Emitation Views
        public function viewDefault()
        {

            $_current = new Builder();
            return $_current->build();

        }

        // Mobile Emitation Views
        public function sendMobile()
        {
            $data = Config::getData();

            $params = [
                'data'       => $data
            ];

            // HTTP Params
            $this->sender->setData( $params );

            // Send Data To Server
            $response = $this->sender->send();

            $this->feedback = new Feedback();
            $this->feedback->setFeedback( $response );
            $this->feedback->parseFeedback();

            // Render Feedback
            $rendered = $this->feedback->build();

            return $rendered;

        }


    }

?>