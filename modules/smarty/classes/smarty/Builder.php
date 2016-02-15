<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 24.02.14
 * Time: 19:14
 */
class Smarty_Builder
{
	protected static $included_javascript = array(
		'lib/jquery/jquery-1.9.0.js',
		//'lib/jquery/jquery-migrate-1.1.0.js',
		'lib/handlebars/handlebars-v1.1.2.js',
		'js/game/base.js',
		//'lib/ember/ember.js',
		'locale/translate.js',
	);
	protected static $included_css = array(
		'base/application.min.css',
		'base/menu.css',
		'base/topbar.css',
	);

	public static function addJavaScript($url)
	{
		self::$included_javascript[] = $url;
	}

	public static function addCss($url)
	{
		self::$included_css[] = $url;
	}

	public static function getJs()
	{
		return self::$included_javascript;
	}
	public static function getCss()
	{
		return self::$included_css;
	}
}