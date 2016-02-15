<?php
	namespace Controller;

	use Auth\Base;
	use Controller;
	use Model\ULogin;
	use Model\User;
    use Utils\Url;

    use Utils\Math;
    use Utils\Protect;

	/**
	 * Class Auth
	 * @package Controller
	 */
	class Auth extends \Builder
	{

		/**
		 * @return bool
		 */
		public function action_login()
		{
			$this->setJSONHeader();
			if($err = Base::createSession($_POST['email'],$_POST['password']))
			{
				$this->response->body(json_encode(['code'=>$err]));
				return false;
			}
			else
			{

				$this->response->body(json_encode(['code'=>0]));
			}
		}

		/**
		 * @return bool
		 */
		public function action_logout()
		{
			header('Content-type: application/json');
			$t = \Auth\Base::destroy();
			if($t)
			{
				$this->response->body(json_encode(['code'=>1]));
			}
			else
			{
				$this->response->body(json_encode(['code'=>0]));
			}
		}

		/**
		 * gets info from social network. If profile already linked to user authenticates, otherwise create new user instance
		 * @throws \Kohana_Database_Exception
		 */
		public function action_uloginAuth()
		{
            $s = file_get_contents('http://ulogin.ru/token.php?token='.$_POST['token'].'&host='.$_SERVER['HTTP_HOST']);
            $user = json_decode($s, true);

			if(strlen($user['error'])> 0)
			{
				$this->response->body($this->template->fetch('internal.tpl'));
				return;
			}

			$condition = (new \DBCriteria())
				->addColumnCondition(
					[
						'uid'    => $user['uid'],
						'network' => $user['network']
					]);


			/** @var $ULogin \Model\ULogin */
			$ULogin = \Model\ULogin::model()->with('user')->find($condition);

			if(null === $ULogin)
			{
				\Session::instance()->set('UloginData',$user);

                $user['bdate'] = date('Y-m-d', strtotime($user['bdate']));

                $this->template->assign([
                    'user'=>$user,
                ]);

				$this->response->body($this->template->fetch('Auth/ulogin.tpl'));
			}
			else
			{
				\Auth\Base::startSession($ULogin['user']);
				$this->redirect(\Route::get('pages')->uri(['controller'=>'Map','action'=>'Add']));
			}
		}

		/**
		 * @throws \Kohana_Database_Exception
		 */
		public function action_continue()
		{

			$user = \Session::instance()->get('UloginData');

			if(!$user)
			{
				$this->response->body($this->template->fetch('internal.tpl'));
				return;
			}

			$dynamic_salt = \Utils\Math::rand();
			$pass = $_POST['password'].\Cookie::$salt;
			$crypted_pass = \Utils\Protect::Crypt($pass,$dynamic_salt);

			$user_model = new User();
			$user_model->first_name = $_POST['first_name'];
			$user_model->email = $_POST['email'];
			$user_model->salt = $dynamic_salt;
			$user_model->pass = $crypted_pass;
            $user_model->gender = $_POST['gender'];
            $user_model->date_birthday = strtotime($_POST['birthday']);
            $user_model->avatar = $_POST['avatar_url'];
            //TODO: uploaded file handler

			$access_level = new \Auth\Access();

			/*Allow user to authenticate*/
			$access_level->set(\Auth\Access::User_Login);
			$user_model->access_level =  $access_level->getValue();

			if(!$user_model->save())
			{
				throw new \Kohana_Database_Exception('Unable to save user model');
			}

			$ULogin = new ULogin();
			$ULogin->network = $user['network'];
			$ULogin->uid = $user['identity'];
			$ULogin->user_id = $user_model->id;

			if(!$ULogin->save())
			{
				$this->response->body('Unable to save social network data');
			}
			else
			{
				$this->redirect(\Route::get('')->uri());
			}
		}

        public function action_recovery()
        {

            $action_status = '';
            if( $recovery = $this->request->post('recovery') )
            {

                $action_status = '';
                $criteria = (new \DBCriteria())->addCondition( 'recovery', $recovery );
                $criteria->condition  = " lifetime > :lifetime ";
                $criteria->params     = array(':lifetime' => time());

                $userInfo = User::model()->find( $criteria );

                if(($userInfo = User::model()->find( $criteria ))
                    && (!empty( $_POST['pass'] )))
                {
                    $dynamic_salt = Math::rand();
                    $pass         = $_POST['pass'].\Cookie::$salt;
                    $crypted_pass = Protect::Crypt($pass,$dynamic_salt);
                    $userInfo->pass = $crypted_pass;
                    $userInfo->salt = $dynamic_salt;
                    $userInfo->recovery = '';

                    if ( $userInfo->save() ){
                        $action_status = 'Password Changed!';
                    }
                }

            } else {
                $recovery = $this->request->param('recovery');
            }

            $this->template->assign([
                'action_status'  => $action_status,
                'recovery'       => $recovery,
            ]);

            $this->response->body($this->template->fetch('portfolio/recovery.tpl'));
        }


		public function action_forgotPassword()
		{
            if( \Request::current()->is_ajax() )
            {

                if($userInfo = User::model()->findByAttributes(['email'=>$_POST['params']['email_send']]))
                {

                    $config_email = \Kohana::$config->load('email');
                    \Email::connect( $config_email );

                    $from = $config_email->get('admin_email');
                    $subject = 'Password Recovery';

                    $to = $_POST['params']['email_send'];

                    // ----------Life Time Code
                    $code = $this->generatePassword();
                    $lifetime = time() + 24*60*60;

                    $userInfo->recovery = $code;
                    $userInfo->lifetime = $lifetime;
                    $userInfo->save();

                    $message = '<strong>Change password Link:</string> <p>
                    <a href="'.\URL::base().'auth/recovery/'.$code.'"></a></p>';
                    // ----------Life Time

                    $send = \Email::send( $to, $from, $subject, $message, $html = true );

                    $this->response->body(json_encode(['code'=> 'Please check your Email!']));
                    return;

                } else {

                    $this->response->body(json_encode(['code'=> 'This Email was not found!']));
                    return true;

                }

            }
		}

		/**
		 * @return bool|void
		 * @throws \Exception
		 * @throws \SmartyException
         */
		public function action_register()
		{
			if(!\Request::current()->is_ajax())
			{
				\Assets::js('register',base_UI.'js/Auth/register.js');
				$this->response->body($this->template->fetch('Auth/register.tpl'));
			}
			else
			{

                $attrs = ['email','pass','pass2','first_name','birthday'];
                foreach($attrs as $item)
                {
                    if(!isset($_POST[$item]))
                    {
                        $this->response->body(json_encode(['code'=>-3]));
                        return;
                    }
                }

                if($userInfo = User::model()->findByAttributes(['email'=>$_POST['email']]))
                {
                    $this->response->body(json_encode(['code'=>-4]));
                    return;
                }

                if($_POST['pass'] !== $_POST['pass2'])
                {
                    $this->response->body(json_encode(['code'=>-1]));
                    return;
                }

                //Create new account
                $_POST['last_login'] = time();
                $user_id = \Auth\Base::create( $_POST );

                if($user_id == false)
                {
                    $this->response->body(json_encode(['code'=>-2]));
                    return true;
                }
                else
                {
                    $this->response->body(json_encode(['code'=>true]));
                    return true;
                }

			}

		}


	}
