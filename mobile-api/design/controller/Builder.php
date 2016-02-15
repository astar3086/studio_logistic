<?php

    Class Builder{

        public $data = [];
        public $view;

        function __construct(){

            // Testing Data
            $this->data = Config::getData();
            $this->template = new Templater();

            // TODO Set API paths
            $design = Settings::$server . 'mobile-api/design/view/assets';
            $this->template->setTemplateAPI( 'design', $design );

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

        //View Template Design
        public function build()
        {

            // Default Testing Data
            $this->template->setData( $this->data,
                'testing_data' );

            // Content && Left Menu
            $this->designBlocks();

            // render Layout
            return $this->template->render();

        }

        //View Template Design
        public function designBlocks()
        {
            // Render Main Blocks

            // render Left Menu
            $view = 'layout' . DS . 'left_menu.php';
            $this->template->setData( Settings::$routing_data, 'routing_data' );
            $this->template->renderPart( $view, 'left_menu' );

            // Input Fields
            $view = 'layout' . DS . 'inputs.php';
            $this->template->renderPart( $view, 'inputs' );

            // response Content
            $this->template->renderPart( $this->view, 'content' );

        }


    }

?>