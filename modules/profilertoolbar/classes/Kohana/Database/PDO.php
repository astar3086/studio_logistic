<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * PDO database connection.
 * @package        Kohana/Database
 * @category       Drivers
 * @author         Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license        http://kohanaphp.com/license
 */
class Kohana_Database_PDO extends Database{

	// PDO uses no quoting for identifiers
	protected $_identifier = '';

	/**
	 * @param $name
	 * @param array $config
	 */
	public function __construct($name, array $config){
		parent::__construct($name, $config);

		if(isset($this->_config['identifier'])){
			// Allow the identifier to be overloaded per-connection
			$this->_identifier = (string)$this->_config['identifier'];
		}
	}

	public function connect(){
		if($this->_connection){
			return;
		}

		// Extract the connection parameters, adding required variabels
		extract($this->_config['connection'] + [
				'dsn'        => '',
				'username'   => null,
				'password'   => null,
				'persistent' => false,
			]);

		// Clear the connection parameters for security
		unset($this->_config['connection']);

		// Force PDO to use exceptions for all errors
		$options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

		if(!empty($persistent)){
			// Make the connection persistent
			$options[PDO::ATTR_PERSISTENT] = true;
		}

		try{
			// Create a new PDO connection
			$this->_connection = new PDO($dsn, $username, $password, $options);
		} catch(PDOException $e){
			throw new Database_Exception(':error', [':error' => $e->getMessage()], $e->getCode());
		}
	}

	/**
	 * Create or redefine a SQL aggregate function.
	 * [!!] Works only with SQLite
	 * @link http://php.net/manual/function.pdo-sqlitecreateaggregate
	 * @param   string $name       Name of the SQL function to be created or redefined
	 * @param   callback $step     Called for each row of a result set
	 * @param   callback $final    Called after all rows of a result set have been processed
	 * @param   integer $arguments Number of arguments that the SQL function takes
	 * @return  boolean
	 */
	public function create_aggregate($name, $step, $final, $arguments = -1){
		$this->_connection or $this->connect();

		return $this->_connection->sqliteCreateAggregate($name, $step, $final, $arguments);
	}

	/**
	 * Create or redefine a SQL function.
	 * [!!] Works only with SQLite
	 * @link http://php.net/manual/function.pdo-sqlitecreatefunction
	 * @param   string $name       Name of the SQL function to be created or redefined
	 * @param   callback $callback Callback which implements the SQL function
	 * @param   integer $arguments Number of arguments that the SQL function takes
	 * @return  boolean
	 */
	public function create_function($name, $callback, $arguments = -1){
		$this->_connection or $this->connect();

		return $this->_connection->sqliteCreateFunction($name, $callback, $arguments);
	}

	/**
	 * @return bool
	 */
	public function disconnect(){
		// Destroy the PDO object
		$this->_connection = null;

		return parent::disconnect();
	}

	/**
	 * @param string $charset
	 */
	public function set_charset($charset){
		// Make sure the database is connected
		$this->_connection OR $this->connect();

		// This SQL-92 syntax is not supported by all drivers
		$this->_connection->exec('SET NAMES ' . $this->quote($charset));
	}

	/**
	 * @param int $type
	 * @param string $sql
	 * @param bool $as_object
	 * @param array $params
	 * @return array|Database_Result_Cached
	 * @throws Database_Exception
	 */
	public function query($type, $sql, $as_object = false, array $params = null){
		// Make sure the database is connected
		$this->_connection or $this->connect();

		if(Kohana::$profiling){
			// Benchmark this query for the current instance
			$benchmark = Profiler::start("Database ({$this->_instance})", $sql);
		}

		try{
			$result = $this->_connection->query($sql);
			if(Kohana::$profiling){
				ProfilerToolbar::setSqlData($this->_instance, $sql, $result->rowCount());
			}
		} catch(Exception $e){
			if(isset($benchmark)){
				// This benchmark is worthless
				Profiler::delete($benchmark);
			}

			// Convert the exception in a database exception
			throw new Database_Exception(':error [ :query ]', [
				':error' => $e->getMessage(),
				':query' => $sql
			], $e->getCode());
		}

		if(isset($benchmark)){
			Profiler::stop($benchmark);
		}

		// Set the last query
		$this->last_query = $sql;

		if($type === Database::SELECT){
			// Convert the result into an array, as PDOStatement::rowCount is not reliable
			if($as_object === false){
				$result->setFetchMode(PDO::FETCH_ASSOC);
			} elseif(is_string($as_object)){
				$result->setFetchMode(PDO::FETCH_CLASS, $as_object, $params);
			} else{
				$result->setFetchMode(PDO::FETCH_CLASS, 'stdClass');
			}

			$result = $result->fetchAll();

			// Return an iterator of results
			return new Database_Result_Cached($result, $sql, $as_object, $params);
		} elseif($type === Database::INSERT){
			// Return a list of insert id and rows created
			return [
				$this->_connection->lastInsertId(),
				$result->rowCount(),
			];
		} else{
			// Return the number of rows affected
			return $result->rowCount();
		}
	}

	/**
	 * @param null $mode
	 * @return mixed
	 */
	public function begin($mode = null){
		// Make sure the database is connected
		$this->_connection or $this->connect();

		return $this->_connection->beginTransaction();
	}

	/**
	 * @return mixed
	 */
	public function commit(){
		// Make sure the database is connected
		$this->_connection or $this->connect();

		return $this->_connection->commit();
	}

	/**
	 * @return mixed
	 */
	public function rollback(){
		// Make sure the database is connected
		$this->_connection or $this->connect();

		return $this->_connection->rollBack();
	}

	/**
	 * @param null $like
	 * @throws Kohana_Exception
	 */
	public function list_tables($like = null){
		throw new Kohana_Exception('Database method :method is not supported by :class', [
			':method' => __FUNCTION__,
			':class'  => __CLASS__
		]);
	}

	/**
	 * @param string $table
	 * @param null $like
	 * @param bool $add_prefix
	 * @return array
	 */
	public function list_columns($table, $like = null, $add_prefix = true){
		// Quote the table name
		$table = ($add_prefix === true) ? $this->quote_table($table) : $table;

		if(is_string($like)){
			// Search for column names
			$result = $this->query(Database::SELECT,
				'SHOW FULL COLUMNS FROM ' . $table . ' LIKE ' . $this->quote($like), false);
		} else{
			// Find all column names
			$result = $this->query(Database::SELECT, 'SHOW FULL COLUMNS FROM ' . $table, false);
		}

		$count = 0;
		$columns = [];
		foreach($result as $row){
			list($type, $length) = $this->_parse_type($row['Type']);

			$column = $this->datatype($type);

			$column['column_name'] = $row['Field'];
			$column['column_default'] = $row['Default'];
			$column['data_type'] = $type;
			$column['is_nullable'] = ($row['Null'] == 'YES');
			$column['ordinal_position'] = ++$count;

			switch($column['type']){
				case 'float':
					if(isset($length)){
						list($column['numeric_precision'], $column['numeric_scale']) = explode(',', $length);
					}
					break;
				case 'int':
					if(isset($length)){
						// MySQL attribute
						$column['display'] = $length;
					}
					break;
				case 'string':
					switch($column['data_type']){
						case 'binary':
						case 'varbinary':
							$column['character_maximum_length'] = $length;
							break;
						case 'char':
						case 'varchar':
							$column['character_maximum_length'] = $length;
						case 'text':
						case 'tinytext':
						case 'mediumtext':
						case 'longtext':
							$column['collation_name'] = $row['Collation'];
							break;
						case 'enum':
						case 'set':
							$column['collation_name'] = $row['Collation'];
							$column['options'] = explode('\',\'', substr($length, 1, -1));
							break;
					}
					break;
			}

			// MySQL attributes
			$column['comment'] = $row['Comment'];
			$column['extra'] = $row['Extra'];
			$column['key'] = $row['Key'];
			$column['privileges'] = $row['Privileges'];

			$columns[$row['Field']] = $column;
		}

		return $columns;
	}

	/**
	 * @param string $value
	 * @return mixed
	 */
	public function escape($value){
		// Make sure the database is connected
		$this->_connection or $this->connect();

		return $this->_connection->quote($value);
	}

} // End Database_PDO