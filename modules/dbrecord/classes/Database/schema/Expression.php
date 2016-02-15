<?php
/**
 * \Database\schema\Expression class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * \Database\schema\Expression represents a DB expression that does not need escaping.
 * \Database\schema\Expression is mainly used in {@link \Database\ActiveRecord\Record} as attribute values.
 * When inserting or updating a {@link \Database\ActiveRecord\Record}, attribute values of
 * type \Database\schema\Expression will be directly put into the corresponding SQL statement
 * without escaping. A typical usage is that an attribute is set with 'NOW()'
 * expression so that saving the record would fill the corresponding column
 * with the current DB server timestamp.
 *
 * Starting from version 1.1.1, one can also specify parameters to be bound
 * for the expression. For example, if the expression is 'LOWER(:value)', then
 * one can set {@link params} to be <code>array(':value'=>$value)</code>.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.schema
 */
namespace Database\schema;
/**
 * Class Expression
 * @package Database\schema
 */
class Expression/* extends CComponent*/
{
	/**
	 * @var string the DB expression
	 */
	public $expression;
	/**
	 * @var array list of parameters that should be bound for this expression.
	 * The keys are placeholders appearing in {@link expression}, while the values
	 * are the corresponding parameter values.
	 * @since 1.1.1
	 */
	public $params=[];

	/**
	 * Constructor.
	 * @param string $expression the DB expression
	 * @param array $params parameters
	 */
	public function __construct($expression,$params=[])
	{
		$this->expression=$expression;
		$this->params=$params;
	}

	/**
	 * String magic method
	 * @return string the DB expression
	 */
	public function __toString()
	{
		return $this->expression;
	}
}