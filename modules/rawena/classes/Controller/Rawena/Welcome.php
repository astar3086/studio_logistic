<?php
/**
 * Created by PhpStorm.
 * User: Desktop
 * Date: 20.02.14
 * Time: 21:08
 */

namespace Controller\Rawena;
use Controller\Rawena\Defaults\AuthTemplate as Source;

class Welcome extends Source {
    public $template = 'rawena/admin/main';
    public function action_index(){
        $this->template->hello = 'I am Rawena';
    }
} 