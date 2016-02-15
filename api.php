<?php
// Mobile API

// Base Separator
define( 'DS', '\\' );

// Base Application Path
define('BASE_PATH', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Base API PAth
define( 'API_PATH', BASE_PATH . 'mobile-api' . DS);

// Base API Content
define( 'API_DESIGN', API_PATH. 'design' .DS);

// Base API Content
define( 'API_CONTENT', API_DESIGN. 'content' .DS);


// Include Main
include_once API_PATH . 'settings'. DS .'Settings.php';

include_once API_PATH . 'Config.php';

include_once API_PATH . 'Autoloder.php';

include_once API_PATH. 'system' . DS . 'Engine.php';

// Init Config
Settings::init();

// Config View or Send
Config::router();

//Engine Rush!
Engine::init();
echo Engine::view();
