<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 02.03.14
 * Time: 14:17
 */
/**
 * \Database\ActiveRecord\MetaData represents the meta-data for an Active Record class.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.ar
 * @since 1.0
 */

namespace Database\ActiveRecord;
use Database\Exception as DBException;
use Database\Exception;

/**
 * Class RecordMetaData
 * @package Database\ActiveRecord
 */
class MetaData {


	/**
	 * @var \TableSchema the table schema information
	 */
	public $tableSchema;
	/**
	 * @var array table columns
	 */
	public $columns;
	/**
	 * @var array list of relations
	 */
	public $relations=[];
	/**
	 * @var array attribute default values
	 */
	public $attributeDefaults=[];

	/**
	 * @var string
	 */
	private $_modelClassName;
	/**
	 * @var Record
	 */
	private $model;

	/**
	 * Constructor.
	 * @param \Database\ActiveRecord\Record $model the model instance
	 * @throws DBException if specified table for active record class cannot be found in the database
	 */
	public function __construct($model)
	{
		$this->_modelClassName= get_class($model);

		/** @var $tableName string */
		$tableName=$model->tableName();
		if(($table=$model->getDbConnection()->getSchema()->getTable($tableName))===null)
			throw new Exception('The table "{'.$tableName.'}" for active record class "{'.$this->_modelClassName.'}" cannot be found in the database.');
		if($table->primaryKey===null)
		{
			$table->primaryKey=$model->primaryKey();
			if(is_string($table->primaryKey) && isset($table->columns[$table->primaryKey]))
				$table->columns[$table->primaryKey]->isPrimaryKey=true;
			elseif(is_array($table->primaryKey))
			{
				foreach($table->primaryKey as $name)
				{
					if(isset($table->columns[$name]))
						$table->columns[$name]->isPrimaryKey=true;
				}
			}
		}
		$this->tableSchema=$table;
		$this->columns=$table->columns;

		foreach($table->columns as $name=>$column)
		{
			if(!$column->isPrimaryKey && $column->defaultValue!==null)
				$this->attributeDefaults[$name]=$column->defaultValue;
		}
		foreach($model->relations() as $name=>$config)
		{
			#@TODO Testing!
			$this->addRelation($name,$config);
		}
		//$this->model = $model;
	}

	/**
	 * Adds a relation.

	 * $config is an array with three elements:
	 * relation type, the related active record class and the foreign key.

	 * @throws DBException
	 * @param string $name $name Name of the relation.
	 * @param array $config $config Relation parameters.
	 * @return void
	 * @since 1.1.2
	 */
	public function addRelation($name,$config)
	{
		if(isset($config[0],$config[1],$config[2]))
		{
			$this->relations[$name]=new $config[0]($name,$config[1],$config[2],array_slice($config,3));

		}// relation class, AR class, FK
		else
		{
			throw new DBException('Active record "'.$this->_modelClassName.'" has an invalid configuration for relation "'.$name.'". It must specify the relation type, the related active record class and the foreign key.');
		}
		//var_dump($this);
	}

	/**
	 * Checks if there is a relation with specified name defined.
	 *
	 * @param string $name $name Name of the relation.
	 * @return boolean
	 * @since 1.1.2
	 */
	public function hasRelation($name)
	{
		return isset($this->relations[$name]);
	}

	/**
	 * Deletes a relation with specified name.
	 *
	 * @param string $name $name
	 * @return void
	 * @since 1.1.2
	 */
	public function removeRelation($name)
	{
		unset($this->relations[$name]);
	}
} 