<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 02.03.14
 * Time: 14:11
 */

namespace Database\ActiveRecord\Relationship;
//use Database\ActiveRecord\Relationship\BaseActiveRelation;
use Database\Exception;
use Database\schema\Criteria;


/**
 * \Database\ActiveRecord\Relationship\Stat represents a statistical relational query.
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.ar
 */
class Stat extends BaseActive
{
	/**
	 * @var string the statistical expression. Defaults to 'COUNT(*)', meaning
	 * the count of child objects.
	 */
	public $select='COUNT(*)';
	/**
	 * @var mixed the default value to be assigned to those records that do not
	 * receive a statistical query result. Defaults to 0.
	 */
	public $defaultValue=0;

	/**
	 * Merges this relation with a criteria specified dynamically.
	 * @param array $criteria    the dynamically specified criteria
	 * @param boolean $fromScope whether the criteria to be merged is from scopes
	 * @throws \Database\Exception
	 */
	public function mergeWith($criteria,$fromScope=false)
	{
		if($criteria instanceof Criteria)
			$criteria=$criteria->toArray();
		parent::mergeWith($criteria,$fromScope);

		if(isset($criteria['defaultValue']))
			$this->defaultValue=$criteria['defaultValue'];
	}
}
