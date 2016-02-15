<?php
/**
 * This file contains core interfaces for Yii framework.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * IBehavior interfaces is implemented by all behavior classes.
 *
 * A behavior is a way to enhance a component with additional methods that
 * are defined in the behavior class and not available in the component class.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 */
interface IBehavior
{
	/**
	 * Attaches the behavior object to the component.
	 * @param CComponent $component the component that this behavior is to be attached to.
	 */
	public function attach($component);
	/**
	 * Detaches the behavior object from the component.
	 * @param CComponent $component the component that this behavior is to be detached from.
	 */
	public function detach($component);
	/**
	 * @return boolean whether this behavior is enabled
	 */
	public function getEnabled();
	/**
	 * @param boolean $value whether this behavior is enabled
	 */
	public function setEnabled($value);
}

/**
 * IWidgetFactory is the interface that must be implemented by a widget factory class.
 *
 * When calling {@link CBaseController::createWidget}, if a widget factory is available,
 * it will be used for creating the requested widget.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.web
 * @since 1.1
 */
interface IWidgetFactory
{
	/**
	 * Creates a new widget based on the given class name and initial properties.
	 * @param CBaseController $owner the owner of the new widget
	 * @param string $className the class name of the widget. This can also be a path alias (e.g. system.web.widgets.COutputCache)
	 * @param array $properties the initial property values (name=>value) of the widget.
	 * @return CWidget the newly created widget whose properties have been initialized with the given values.
	 */
	public function createWidget($owner,$className,$properties=[]);
}

/**
 * IDataProvider is the interface that must be implemented by data provider classes.
 *
 * Data providers are components that can feed data for widgets such as data grid, data list.
 * Besides providing data, they also support pagination and sorting.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.web
 * @since 1.1
 */
interface IDataProvider
{
	/**
	 * @return string the unique ID that identifies the data provider from other data providers.
	 */
	public function getId();
	/**
	 * Returns the number of data items in the current page.
	 * This is equivalent to <code>count($provider->getData())</code>.
	 * When {@link pagination} is set false, this returns the same value as {@link totalItemCount}.
	 * @param boolean $refresh whether the number of data items should be re-calculated.
	 * @return integer the number of data items in the current page.
	 */
	public function getItemCount($refresh=false);
	/**
	 * Returns the total number of data items.
	 * When {@link pagination} is set false, this returns the same value as {@link itemCount}.
	 * @param boolean $refresh whether the total number of data items should be re-calculated.
	 * @return integer total number of possible data items.
	 */
	public function getTotalItemCount($refresh=false);
	/**
	 * Returns the data items currently available.
	 * @param boolean $refresh whether the data should be re-fetched from persistent storage.
	 * @return array the list of data items currently available in this data provider.
	 */
	public function getData($refresh=false);
	/**
	 * Returns the key values associated with the data items.
	 * @param boolean $refresh whether the keys should be re-calculated.
	 * @return array the list of key values corresponding to {@link data}. Each data item in {@link data}
	 * is uniquely identified by the corresponding key value in this array.
	 */
	public function getKeys($refresh=false);
	/**
	 * @return CSort the sorting object. If this is false, it means the sorting is disabled.
	 */
	public function getSort();
	/**
	 * @return CPagination the pagination object. If this is false, it means the pagination is disabled.
	 */
	public function getPagination();
}


/**
 * ILogFilter is the interface that must be implemented by log filters.
 *
 * A log filter preprocesses the logged messages before they are handled by a log route.
 * You can attach classes that implement ILogFilter to {@link CLogRoute::$filter}.
 *
 * @package system.logging
 * @since 1.1.11
 */
interface ILogFilter
{
	/**
	 * This method should be implemented to perform actual filtering of log messages
	 * by working on the array given as the first parameter.
	 * Implementation might reformat, remove or add information to logged messages.
	 * @param array $logs list of messages. Each array element represents one message
	 * with the following structure:
	 * array(
	 *   [0] => message (string)
	 *   [1] => level (string)
	 *   [2] => category (string)
	 *   [3] => timestamp (float, obtained by microtime(true));
	 */
	public function filter(&$logs);
}

