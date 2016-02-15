<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 16.07.2014
 * Time: 20:35
 */
namespace Utils;
/**
 * Class Url
 * @package Utils
 */
class Url
{
	/**
	 * @param $routeName
	 * @param $controller
	 * @param string $action
	 * @return string
	 */
	public static function get($routeName,$controller,$action = '')
	{
        if(null == $action)
		{
			return \Kohana::$base_url.\Route::get($routeName)->uri(['controller'=>$controller]);
		}
		else
		{
			return \Kohana::$base_url.\Route::get($routeName)->uri(['controller'=>$controller,'action'=>$action]);
		}
	}
}