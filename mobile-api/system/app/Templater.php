<?php

    Class Templater{

        public $view_path;
        public $html_block = [];
        public $data = [];

        function __construct()
        {
            $render_path =  Settings::$render_path[ Config::$mobile_mode ];

            // Template path
            $this->view_path = API_DESIGN . 'view' . DS;
            $this->template = $this->view_path . $render_path;

        }

        //Render Layout
        public function render()
        {

            $rendered = $this->renderFrame();
            return $rendered;

        }

        //TODO Render Current View
        public function renderPart( $view, $position )
        {
            $rendered = '';
            $data = $this->data;

            if ( $view )
            {

                // path to view
                $view = $this->template . DS .$view;

                if ( file_exists( $view ) )
                {
                    ob_start();

                    include $view;

                    $rendered = ob_get_clean();
                    $this->html_block[ $position ] = $rendered;
                }


            } else
            {
                $this->html_block[ $position ] = '[Block:'.$position.':No Data]';
            }

            return $rendered;
        }

        //Render Layout ( TODO Templater )
        public function renderFrame()
        {
            $blocks = $this->html_block;

            if ( !Config::$is_ajax )
            {
                // Layout path
                $this->layout = $this->view_path . Config::$layout;

            } else
            {
                // AJAX LAyout View
                $this->layout = $this->template . DS . 'default.php';
            }

            ob_start();

            include $this->layout;

            $render = ob_get_clean();
            return $render;
        }

        //Set Template Variables
        public function setTemplateAPI( $variable, $data )
        {
            $this->html_block['api'][$variable] = $data;
        }

        //Set Template Variables
        public function setData( $data, $key )
        {
            if ( is_array( $data ) && !array_key_exists( $key, $data ) )
            {
                $this->data[ $key ] = $data;
            }
        }

        // Templates Directory
        public function setTemplate( $template )
        {
            if ( file_exists( $this->view_path . $template ) )
            {
                $this->template = $template;
            }
        }


    }

?>