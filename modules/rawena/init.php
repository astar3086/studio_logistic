<?php
/**
 * Created by PhpStorm.
 * User: Desktop
 * Date: 20.02.14
 * Time: 20:02
 */
require_once MODPATH. 'rawena/classes/Rawena/Tools/Loader.php';

spl_autoload_register(new Rawena\Tools\Loader());


Rawena::init();

/*$rawena = Route::set('rawena', 'admin(/<controller>(/<action>(/<id>)))')

    ->defaults(array(
        'controller' => 'welcome',
        'action'     => 'index',
        'directory' => 'Rawena',
    ));*/

    //$rawena->filter(array('Rawena\Tools\Loader','filter'));

//$n = new Rawena();