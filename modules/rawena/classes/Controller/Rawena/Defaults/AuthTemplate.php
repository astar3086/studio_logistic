<?php
/**
 * Created by PhpStorm.
 * User: Desktop
 * Date: 20.02.14
 * Time: 23:01
 */

namespace Controller\Rawena\Defaults;


class AuthTemplate extends Auth {
    public $template = 'template';
    /**
     * @var Smarty
     */


    /**
     * @var  boolean  auto render template
     **/
    public $auto_render = TRUE;

    /**
     * Loads the template [View] object.
     */
    public function before()
    {
        parent::before();

        if ($this->auto_render === TRUE)
        {
            $template_class = '\\' . ($tmplb = \Kohana::$config->load('rawena')->get('template_base')) ? $tmplb : 'View';
            $this->template = new $template_class($this->template);
        }
    }

    /**
     * Assigns the template [View] as the request response.
     */
    public function after()
    {
        if ($this->auto_render === TRUE)
        {
            $this->response->body($this->template->render());
        }
        parent::after();
    }

} 