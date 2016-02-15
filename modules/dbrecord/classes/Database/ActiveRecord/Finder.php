<?php
/**
 * \Database\ActiveRecord\Finder class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * \Database\ActiveRecord\Finder implements eager loading and lazy loading of related active records.
 *
 * When used in eager loading, this class provides the same set of find methods as
 * {@link \Database\ActiveRecord\Record}.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.ar
 * @since 1.0
 */
namespace Database\ActiveRecord;
/**
 * Class Finder
 * @package Database\ActiveRecord
 */
use Database\Exception;

/**
 * Class Finder
 * @package Database\ActiveRecord
 */
class Finder/* extends CComponent*/
{
	/**
	 * @var boolean join all tables all at once. Defaults to false.
	 * This property is internally used.
	 */
	public $joinAll=false;
	/**
	 * @var boolean whether the base model has limit or offset.
	 * This property is internally used.
	 */
	public $baseLimited=false;

	/**
	 * @var int
	 */
	private $_joinCount=0;
	/**
	 * @var Join\Element
	 */
	private $_joinTree;
	/**
	 * @var
	 */
	private $_builder;

	/**
	 * Constructor.
	 * A join tree is built up based on the declared relationships between active record classes.
	 * @param \Database\ActiveRecord\Record $model the model that initiates the active finding process
	 * @param mixed $with the relation names to be actively looked for
	 */
	public function __construct($model,$with)
	{
		$this->_builder=$model->getCommandBuilder();
		$this->_joinTree=new Join\Element($this,$model);
		$this->buildJoinTree($this->_joinTree,$with);
	}

	/**
	 * Do not call this method. This method is used internally to perform the relational query
	 * based on the given DB criteria.
	 * @param \Database\schema\Criteria $criteria the DB criteria
	 * @param boolean $all whether to bring back all records
	 * @return mixed the query result
	 */
	public function query($criteria,$all=false)
	{
		$this->joinAll=$criteria->together===true;

		if($criteria->alias!='')
		{
			$this->_joinTree->tableAlias=$criteria->alias;
			$this->_joinTree->rawTableAlias=$this->_builder->getSchema()->quoteTableName($criteria->alias);
		}

		$this->_joinTree->find($criteria);
		$this->_joinTree->afterFind();

		if($all)
		{
			$result = array_values($this->_joinTree->records);
			if ($criteria->index!== null )
			{
				$index=$criteria->index;
				$array=[];
				foreach($result as $object)
					$array[$object->$index]=$object;
				$result=$array;
			}
		}
		elseif(count($this->_joinTree->records))
			$result = reset($this->_joinTree->records);
		else
			$result = null;

		$this->destroyJoinTree();
		return $result;
	}

	/**
	 * This method is internally called.
	 * @param string $sql the SQL statement
	 * @param array $params parameters to be bound to the SQL statement
	 * @return \Database\ActiveRecord\Record
	 */
	public function findBySql($sql,$params=[])
	{
		var_echo(get_class($this->_joinTree->model).'.findBySql() eagerly','Database_ActiveRecord_Record');
		if(($row=$this->_builder->createSqlCommand($sql,$params)->queryRow())!==false)
		{
			$baseRecord=$this->_joinTree->model->populateRecord($row,false);
			$this->_joinTree->findWithBase($baseRecord);
			$this->_joinTree->afterFind();
			$this->destroyJoinTree();
			return $baseRecord;
		}
		else
			$this->destroyJoinTree();
	}

	/**
	 * This method is internally called.
	 * @param string $sql the SQL statement
	 * @param array $params parameters to be bound to the SQL statement
	 * @return \Database\ActiveRecord\Record[]
	 */
	public function findAllBySql($sql,$params=[])
	{
		var_echo(get_class($this->_joinTree->model).'.findAllBySql() eagerly','Database_ActiveRecord_Record');
		if(($rows=$this->_builder->createSqlCommand($sql,$params)->queryAll())!==[])
		{
			$baseRecords=$this->_joinTree->model->populateRecords($rows,false);
			$this->_joinTree->findWithBase($baseRecords);
			$this->_joinTree->afterFind();
			$this->destroyJoinTree();
			return $baseRecords;
		}
		else
		{
			$this->destroyJoinTree();
			return [];
		}
	}

	/**
	 * This method is internally called.
	 * @param \Database\schema\Criteria $criteria the query criteria
	 * @return string
	 */
	public function count($criteria)
	{
		var_echo(get_class($this->_joinTree->model).'.count() eagerly','Database_ActiveRecord_Record');
		$this->joinAll=$criteria->together!==true;

		$alias=$criteria->alias === null ? 't' : $criteria->alias;
		$this->_joinTree->tableAlias=$alias;
		$this->_joinTree->rawTableAlias = $this->_builder->getSchema()->quoteTableName($alias);

		$n=$this->_joinTree->count($criteria);
		$this->destroyJoinTree();
		return $n;
	}

	/**
	 * Finds the related objects for the specified active record.
	 * This method is internally invoked by {@link \Database\ActiveRecord\Record} to support lazy loading.
	 * @param \Database\ActiveRecord\Record $baseRecord the base record whose related objects are to be loaded
	 */
	public function lazyFind($baseRecord)
	{
		$this->_joinTree->lazyFind($baseRecord);
		if(!empty($this->_joinTree->children))
		{
			foreach($this->_joinTree->children as $child)
				$child->afterFind();
		}
		$this->destroyJoinTree();
	}

	/**
	 * Given active record class name returns new model instance.
	 *
	 * @param string $className active record class name
	 * @return \Database\ActiveRecord\Record active record model instance
	 *
	 * @since 1.1.14
	 */
	public function getModel($className)
	{
		return \Database\ActiveRecord\Record::model($className);
	}

	/**
	 *
	 */
	private function destroyJoinTree()
	{
		if($this->_joinTree!==null)
			$this->_joinTree->destroy();
		$this->_joinTree=null;
	}

	/**
	 * Builds up the join tree representing the relationships involved in this query.
	 * @param Join\Element $parent the parent tree node
	 * @param mixed $with          the names of the related objects relative to the parent tree node
	 * @param array $options       additional query options to be merged with the relation
	 * @return \Database\ActiveRecord\\Database\ActiveRecord\Join\Element|\Database\ActiveRecord\CStatElement
	 * @throws Exception if given parent tree node is an instance of {@link CStatElement}
	 *                             or relation is not defined in the given parent's tree node model class
	 */
	private function buildJoinTree($parent,$with,$options=null)
	{
		if($parent instanceof CStatElement)
			throw new Exception(Yii::t('yii','The STAT relation "{name}" cannot have child relations.',
				['{name}'=>$parent->relation->name]));

		if(is_string($with))
		{
			if(($pos=strrpos($with,'.'))!==false)
			{
				$parent=$this->buildJoinTree($parent,substr($with,0,$pos));
				$with=substr($with,$pos+1);
			}

			// named scope
			$scopes=[];
			if(($pos=strpos($with,':'))!==false)
			{
				$scopes=explode(':',substr($with,$pos+1));
				$with=substr($with,0,$pos);
			}

			if(isset($parent->children[$with]) && $parent->children[$with]->master===null)
				return $parent->children[$with];

			if(($relation=$parent->model->getActiveRelation($with))===null)
				throw new Exception('Relation "{'.$with.'}" is not defined in active record class "{'.get_class($parent->model).'}".');

			$relation=clone $relation;
			$model=$this->getModel($relation->className);

			if($relation instanceof Relationship\Active)
			{
				$oldAlias=$model->getTableAlias(false,false);
				if(isset($options['alias']))
					$model->setTableAlias($options['alias']);
				elseif($relation->alias===null)
					$model->setTableAlias($relation->name);
				else
					$model->setTableAlias($relation->alias);
			}

			if(!empty($relation->scopes))
				$scopes=array_merge($scopes,(array)$relation->scopes); // no need for complex merging

			if(!empty($options['scopes']))
				$scopes=array_merge($scopes,(array)$options['scopes']); // no need for complex merging

			$model->resetScope(false);
			$criteria=$model->getDbCriteria();
			$criteria->scopes=$scopes;
			$model->beforeFindInternal();
			$model->applyScopes($criteria);

			// select has a special meaning in stat relation, so we need to ignore select from scope or model criteria
			if($relation instanceof \Database\ActiveRecord\Relationship\Stat)
				$criteria->select='*';

			$relation->mergeWith($criteria,true);

			// dynamic options
			if($options!==null)
				$relation->mergeWith($options);

			if($relation instanceof Relationship\Active)
				$model->setTableAlias($oldAlias);

			if($relation instanceof \Database\ActiveRecord\Relationship\Stat)
				return new \Database\ActiveRecord\Relationship\Stat($this,$relation,$parent);
			else
			{
				if(isset($parent->children[$with]))
				{
					$element=$parent->children[$with];
					$element->relation=$relation;
				}
				else
					$element=new Join\Element($this,$relation,$parent,++$this->_joinCount);
				if(!empty($relation->through))
				{
					$slave=$this->buildJoinTree($parent,$relation->through,['select'=>'']);
					$slave->master=$element;
					$element->slave=$slave;
				}
				$parent->children[$with]=$element;
				if(!empty($relation->with))
					$this->buildJoinTree($element,$relation->with);
				return $element;
			}
		}

		// $with is an array, keys are relation name, values are relation spec
		foreach($with as $key=>$value)
		{
			if(is_string($value))  // the value is a relation name
				$this->buildJoinTree($parent,$value);
			elseif(is_string($key) && is_array($value))
				$this->buildJoinTree($parent,$key,$value);
		}
	}
}


