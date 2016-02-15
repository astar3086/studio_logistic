<?php

    Class Feedback{
        private $template;
        public $response;

        public $data = [];
        public $view;

        function __construct(){

            // Testing Data
            $this->data = Config::getFeedbackData();
            $this->template = new Templater();

            // Template path
            if ( Config::$controller )
            {
                $this->view = Config::$controller . DS
                    . Config::$action . '.php';

            } else
            {
                // Default Design
                $this->view = false;
            }

        }

        // TODO Response Decoder
        public function setFeedback( $response )
        {
            $this->response = json_decode( $response );
        }

        // Fill response array
        public function parseFeedback()
        {
            if ( !empty( $this->response ))
            {
                foreach ( $this->data as $key => $fvalue )
                {
                    if ( $this->response->$key )
                    {
                        $this->data[ $key ] = $this->response->$key;
                    }
                }

                $this->data['feedback'] = $this->response;
            }
        }

        //View Template Design
        public function build()
        {

            $this->template->setData( $this->data, 'response' );

            // Default Response Block
            $view = 'layout' . DS . 'response.php';
            $this->template->renderPart( $view, 'response' );

            // render Content
            $this->template->renderPart( $this->view, 'content' );

            // render Layout
            return $this->template->render();

        }



    }

?>