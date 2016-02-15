<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 13.11.13
 * Time: 22:18
 */
namespace Controller;

use Smarty\View;
use \Controller;

/**
 * @property mixed tplobj
 */
class Smarty extends Controller {
	public $template = 'template';
	/**
	 * @var \smarty\View
	 */
	protected $smarty_object;

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
			// Load the template
			$this->smarty_object = View::factory($this->template);
		}
	}

	/**
	 * Assigns the template [View] as the request response.
	 */
	public function after()
	{
		if ($this->auto_render === TRUE)
		{
			$this->response->body($this->tplobj->render());
		}
		parent::after();
	}

	public function render($tpl_file = '')
	{
		if(sizeof($tpl_file)>0)
		{
			$this->smarty_object = $tpl_file;
		}
		return $this->smarty_object->fetch();
	}
} 