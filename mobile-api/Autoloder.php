<?php

    Class Autoloder{

        public static function load()
        {
            foreach (Config::$system as $key => $classpath)
            {
                include_once API_PATH . $classpath;
            }

            return;
        }
    }

?>