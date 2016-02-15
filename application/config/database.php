<?php defined('SYSPATH') OR die('No direct access allowed.');

return
	[
		'default' =>
			[
				/**
				 * The following options are available for PDO:

				 * string   dsn         Data Source Name
				 * {DRIVER_Name} is
				 * 'pgsql'// PostgreSQL
				 * 'mysqli'// MySQL
				 *  'mysql' // MySQL
				 *  'sqlite' // sqlite 3
				 *  'sqlite2'// sqlite 2
				 *  'mssql'// Mssql driver on windows hosts
				 *  'dblib'// dblib drivers on linux (and maybe others os) hosts
				 *  'sqlsrv'// Mssql
				 *  'oci'// Oracle driver
				 * [STABLE WORK] MySQL,mysqli
				 * string   username    database username
				 * string   password    database password
				 * boolean  persistent  use persistent connections?
				 */
				'connectionString' => 'mysql:host=localhost;dbname=logistic',
				'username'         => 'root',
				'password'         => '',
				'persistent'       => false,
				/**
				 * The following extra options are available for PDO:
				 * string   identifier  set the escaping identifier
				 */
				'tablePrefix'      => '',
				'charset'          => 'utf8',
				'caching'          => false,
				'enableProfiling'  => true,
                //'options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'),
			],

	];