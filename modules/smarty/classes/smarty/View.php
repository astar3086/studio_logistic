<?php

namespace Smarty;

/**
 * Class View
 * @package Smarty
 */
class View
{
	/**
	 * @var \SmartyBC
	 */
	private $_instance;
	/**
	 * @var string
	 */
	private $_filename;

	/**
	 * @param $filename
	 */
	public function __construct($filename)
	{
		//\Route::name(\Request::current()->uri());
		$path = \Kohana::find_file('views',$filename,'tpl');
		$this->_filename = ($path && ($f_path = str_replace('.tpl','',$path))) ? $f_path : '';
		$this->_instance = self::init();
	}


	/**
	 * @return \SmartyBC
	 * @throws \Kohana_Exception
	 */
	public static function init()
	{
		$tmp = new \SmartyBC();
		$tmp->muteExpectedErrors();
		//loading config file smarty
		$conf = \Kohana::$config->load('smarty')->get('smarty_config');
		$tmp->addTemplateDir($conf['template_dir']);
		$tmp->setCompileDir($conf['compile_dir']);
		$tmp->setCacheDir($conf['cache_dir']);
		$tmp->setConfigDir($conf['config_dir']);
		$tmp->setPluginsDir($conf['plugins_dir']);
		$tmp->assign('base_UI',$conf['base_UI']);
		$tmp->assign('debugging',$conf['debugging']);
		$tmp->debugging = $conf['debugging'];
		$tmp->debugging_ctrl = $conf['debugging_ctrl'];
		$tmp->error_reporting = $conf['error_reporting'];
		return $tmp;
	}

	/**
	 * @param $filename
	 * @return \Smarty\View
	 */
	public static function factory($filename)
	{
		return new View($filename);
	}

	/**
	 * @param $index
	 * @param $value
	 */
	public function __set($index,$value)
	{
		$this->_instance->assign($index,$value);
	}

	/**
	 * @param $method
	 * @param array $args
	 * @throws \Exception
	 * @return mixed
	 */
	public function __call($method,$args = [])
	{
		if(method_exists($this->_instance,$method))
		{
			return call_user_func_array([$this->_instance,$method],$args);
		}
		else
		{
			throw new \Exception('method not exists');
		}
	}

	/**
	 * @return string
	 */
	public function render()
	{
		return $this->_instance->fetch($this->_filename . '.tpl');
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}
} 