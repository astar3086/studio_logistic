<?php

class Registry
{
	/**
	 * @var \Model\User
	 */
	private static $current_user;

	private static $config;

	/**
	 * @return \Model\User|null
	 */
	public static function getCurrentUser()
	{
		return \Session::instance()->get('Registry_User');
	}

	/**
	 * @param \Model\User $obj
	 */
	public static function setCurrentUser(\Model\User $obj)
	{
        \Session::instance()->set('Registry_User',$obj);
	}

}
