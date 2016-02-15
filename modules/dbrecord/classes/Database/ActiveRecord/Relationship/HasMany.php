<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 02.03.14
 * Time: 14:33
 */

namespace Database\ActiveRecord\Relationship;
use Database\schema\Criteria;
/**
 * Class HasMany represents the parameters specifying a HAS_MANY relation.
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package Database\ActiveRecord\Relationship
 * @since 1.0
 */

class HasMany extends Active
{
	/**
	 * @var integer limit of the rows to be selected. It is effective only for lazy loading this related object. Defaults to -1, meaning no limit.
	 */
	public $limit=-1;
	/**
	 * @var integer offset of the rows to be selected. It is effective only for lazy loading this related object. Defaults to -1, meaning no offset.
	 */
	public $offset=-1;
	/**
	 * @var string the name of the column that should be used as the key for storing related objects.
	 * Defaults to null, meaning using zero-based integer IDs.
	 */
	public $index;

	/**
	 * Merges this relation with a criteria specified dynamically.
	 * @param array $criteria the dynamically specified criteria
	 * @param boolean $fromScope whether the criteria to be merged is from scopes
	 */
	public function mergeWith($criteria,$fromScope=false)
	{
		if($criteria instanceof Criteria)
			$criteria=$criteria->toArray();
		parent::mergeWith($criteria,$fromScope);
		if(isset($criteria['limit']) && $criteria['limit']>0)
			$this->limit=$criteria['limit'];

		if(isset($criteria['offset']) && $criteria['offset']>=0)
			$this->offset=$criteria['offset'];

		if(isset($criteria['index']))
			$this->index=$criteria['index'];
	}
}