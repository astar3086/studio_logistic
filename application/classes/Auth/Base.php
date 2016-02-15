<?php
namespace Auth;
use Model\User;
use Model\UserSession;
use Utils\Math;
use Utils\Protect;

/**
 * Class Base
 * @package Auth
 */
class Base
{

	/**
	 * @return UserSession|bool
	 * @throws \Kohana_Exception
	 */
	public static function Check()
	{
		$conf = \Kohana::$config->load('session')->get('native');
		$condition = (new \DBCriteria())
			->addColumnCondition(
			[
				'ip'    => \Request::$client_ip,
                'iduser' => \Session::instance()->get('user_id',false),
		        'token' => self::getToken()
			])
			->addCondition('`expired`>=UNIX_TIMESTAMP(NOW())');

		/** @var $dbSession UserSession */
		$dbSession = UserSession::model()->find($condition);

		//if we not found row in BD
		if(is_null($dbSession))
		{
			return false;
		}

		//If session key destroy in Cookie and Session(memcahed)
		if(!\Cookie::get('user_token',false) and  !\Session::instance()->get('user_token',false))
		{
			$dbSession->expired = time() + $conf['lifetime'];
			if($dbSession->save())
			{
				\Session::instance()->set('user_id',$dbSession->id);
				\Cookie::set('user_token',$dbSession['token'],time() + $conf['lifetime']);
				\Session::instance()->set('user_token',$dbSession['token']);
				return $dbSession;
				//return true;
			}
			else
			{
				\Kohana::$log->add(\Log::WARNING,'Error to update session in [ID#'.$dbSession->owner->login.']');
				return true;
			}

		}
		//if user token in Cookie <> Session
		else
		{

			if(\Cookie::get('user_token',false) !== \Session::instance()->get('user_token',false))
			{
				\Kohana::$log->add(\Log::WARNING, 'Session Key <> Cookie Key');
			}
			$expired = time() + $conf['lifetime'];
			$dbSession->expired = $expired;
			$dbSession->save(false);
			\Cookie::set('user_token', $dbSession->token, $expired);
			return $dbSession;
		}

	}


	/**
	 * @param $userInfo
	 * @return bool
	 * @throws \Kohana_Exception
	 */
	public static function startSession( $userInfo )
	{
		/** @var $conf array */
		$conf = \Kohana::$config->load('session')->get('native');

		/** @var $dbSession UserSession */
		$condition = (new \DBCriteria())
				->addColumnCondition(
						[
								'ip'    => \Request::$client_ip,
								'token' => self::getToken()
						])
				->addCondition('`expired`>=UNIX_TIMESTAMP(NOW())');

		/** @var $dbSession UserSession */
		$sessionData = UserSession::model()->find($condition);

		if ( !$sessionData ){
			$sessionData = new UserSession();
			$sessionData->iduser = $userInfo->iduser;
			$sessionData->ip = \Request::$client_ip;
			$sessionData->expired = time()+$conf['lifetime'];
			$sessionData->token = self::getToken();
		}

		if($sessionData->save(false))
		{

            \Session::instance()->set('user_id',$userInfo->iduser);
			\Session::instance()->set('user_token',$sessionData->token);
			\Registry::setCurrentUser($userInfo);
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @return bool|int
	 */
	public static function create( $data )
	{
		$dynamic_salt = Math::rand();
		$pass = $data['pass'].$dynamic_salt;
		$crypted_pass = Protect::Crypt($pass,$dynamic_salt);

		$user_data = new User();
		//$user_data->login = $data['login'];
		$user_data->email = $data['email'];
        $user_data->first_name = $data['first_name'];
		$user_data->phone = $data['phone'];
		if ( $data['last_name'] ) $user_data->last_name = $data['last_name'];

		$user_data->pass = $crypted_pass;
        $user_data->gender =  $data['gender'];
        $user_data->date_birthday = strtotime($data['birthday']);
		$user_data->salt = $dynamic_salt;
		$access_level = new Access();

		/*Разрешаем юзверю банально логинится*/
		$access_level->set(Access::User_Login);
		$user_data->access_level = $access_level->getValue();

		if($user_data->save())
		{
			return $user_data;
		}
		else
		{
			return false;
		}

	}

	/**
	 * @param $mail
	 * @param $pass
	 * @return bool|int
	 */
	public static function createSession( $mail, $pass )
	{

		/** @var $userInfo User */
		if(!$userInfo = User::model()->findByAttributes(['email'=>$mail]))
		{
			return -1;
		}

		//$pass = Protect::Crypt($pass.\Cookie::$salt,$userInfo->salt);
		$pass = Protect::Crypt($pass.$userInfo->salt,$userInfo->salt);

		//Если пароли не совпадают
		if($pass <> $userInfo->pass)
		{
			return -2;
		}
		$access      = new \Auth\Access($userInfo->access_level);
        $isAdmin     = $access->get(\Auth\Access::User_Is_Admin);
        $isModerator = $access->get(\Auth\Access::User_Is_Moderator);

		//Если юзверю не разрешено логинится
		/*if( !$isAdmin && !$isModerator  )
		{
			return -3;
		}*/

		return self::startSession($userInfo);

	}

	/**
	 * @return string
	 */
	private static function getToken()
	{
		$salt = \Kohana::$config->load('session')->get('native');
		return Protect::Crypt(\Request::$user_agent,$salt['salt']);
	}


	/**
	 * @return bool
	 * @throws \Database\Exception
	 * @throws \Kohana_Exception
	 */
	public static function destroy()
	{

        if(true == ($userSession = self::Check()))
        {
			\Session::instance()->delete('user_id');
			\Cookie::delete('user_token');

            if ( is_object($userSession) ){
                return $userSession->deleteAll();
            } else {
                return $userSession;
            }


		}
		else
		{

			\Session::instance()->delete('user_id');
			\Cookie::delete('user_token');
			//throw new \Kohana_Exception('Error destroy session');
			return false;
		}
	}

}