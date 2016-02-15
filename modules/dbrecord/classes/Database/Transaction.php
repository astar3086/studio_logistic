<?php
/**
 * \Database\Transaction class file
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * \Database\Transaction represents a DB transaction.
 *
 * It is usually created by calling {@link \Database\Connection::beginTransaction}.
 *
 * The following code is a common scenario of using transactions:
 * <pre>
 * $transaction=$connection->beginTransaction();
 * try
 * {
 *    $connection->createCommand($sql1)->execute();
 *    $connection->createCommand($sql2)->execute();
 *    //.... other SQL executions
 *    $transaction->commit();
 * }
 * catch(Exception $e)
 * {
 *    $transaction->rollback();
 * }
 * </pre>
 *
 * @property \Database\Connection $connection The DB connection for this transaction.
 * @property boolean $active Whether this transaction is active.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db
 * @since 1.0
 */
namespace Database;

/**
 * Class Transaction
 * @package Database
 */
class Transaction/* extends CComponent*/
{
	/**
	 * @var Connection|null
	 */
	private $_connection=null;
	/**
	 * @var bool
	 */
	private $_active;

	/**
	 * Constructor.
	 * @param Connection $connection the connection associated with this transaction
	 * @see \Database\Connection::beginTransaction
	 */
	public function __construct(Connection $connection)
	{
		$this->_connection=$connection;
		$this->_active=true;
	}

	/**
	 * Commits a transaction.
	 * @throws \Database\Exception if the transaction or the DB connection is not active.
	 */
	public function commit()
	{
		if($this->_active && $this->_connection->getActive())
		{
			//Yii::trace('Committing transaction','system.db.CDbTransaction');
			$this->_connection->getPdoInstance()->commit();
			$this->_active=false;
		}
		else
			//throw new \Database\Exception(Yii::t('yii','CDbTransaction is inactive and cannot perform commit or roll back operations.'));
			die('\Database\Transaction is inactive and cannot perform commit or roll back operations.');
	}

	/**
	 * Rolls back a transaction.
	 * @throws \Database\Exception if the transaction or the DB connection is not active.
	 */
	public function rollback()
	{
		if($this->_active && $this->_connection->getActive())
		{
			//Yii::trace('Rolling back transaction','system.db.CDbTransaction');
			$this->_connection->getPdoInstance()->rollBack();
			$this->_active=false;
		}
		else
			//throw new \Database\Exception(Yii::t('yii','CDbTransaction is inactive and cannot perform commit or roll back operations.'));
			die('CDbTransaction is inactive and cannot perform commit or roll back operations.');
	}

	/**
	 * @return Connection the DB connection for this transaction
	 */
	public function getConnection()
	{
		return $this->_connection;
	}

	/**
	 * @return boolean whether this transaction is active
	 */
	public function getActive()
	{
		return $this->_active;
	}

	/**
	 * @param boolean $value whether this transaction is active
	 */
	protected function setActive($value)
	{
		$this->_active=$value;
	}
}
