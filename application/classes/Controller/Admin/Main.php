<?php
    namespace Controller\Admin;

	use Auth\Base;
    use Assets;
    use Builder\System;
	use Model\ULogin;
	use Model\User;
    use Utils\Url;

	/**
	 * Class Auth
	 * @package Controller
	 */
	class Main extends System
    {

        /**
         *
         */
        public function action_index()
        {

            if(\Registry::getCurrentUser()->isGuest())
            {
                \HTTP::redirect(\Route::get('SystemRoute')->uri(['controller'=>'Main','action'=>'Login']), 302);
            }
            else
            {
                \HTTP::redirect(\Route::get('SystemRoute')->uri(['controller'=>'Users','action'=>'Index']), 302);
            }
        }

        /**
         *
         */
        public function action_login()
        {

            if($this->request->is_ajax())
            {
                if (\HTTP_Request::POST == $this->request->method())
                {
                    $status = \Auth\Base::createSession($_POST['email'],$_POST['pass']);
                    $this->response->body(json_encode(['code'=>$status]));
                    return true;
                }
            }
            else
            {

                Assets::js('login',base_UI.'js/index/login.js');

                if( \Registry::getCurrentUser()->isGuest() )
                {
                    $this->response->body( $this->template->fetch('admin/index/Login.tpl') );
                }
                else
                {
                    \HTTP::redirect(\Route::get('SystemRoute')->uri(['controller'=>'Users','action'=>'Index']), 302);
                }
            }


        }

        /**
         *
         */
        public function action_logout()
        {

            if( !\Registry::getCurrentUser()->isGuest() )
            {
                \Auth\Base::destroy();
            }

            \HTTP::redirect(\Route::get('SystemRoute')->uri(['controller'=>'Main','action'=>'Login']), 302);
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
                $user['bdate'] = strtotime($user['bdate']);

                $user_model = new User();
                $user_model->login = $_POST['login'];
                $user_model->first_name      = $_POST['first_name'];
                $user_model->email    = $_POST['email'];

                $access_level = new \Auth\Access();
                $access_level->set(\Auth\Access::User_Login);
                $user_model->access_level =  $access_level->getValue();

                if(!$user_model->save())
                {
                    throw new \Kohana_Database_Exception('Unable to save user model');
                }

                $ULogin          = new ULogin();
                $ULogin->network = $user['network'];
                $ULogin->uid     = $user['identity'];
                $ULogin->user_id = $user_model->id;

                if(!$ULogin->save())
                {
                    $this->response->body('Unable to save social network data');
                }

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
			$user_model->nickname = $_POST['nickname'];
			$user_model->first_name  = $_POST['first_name'];
			$user_model->email    = $_POST['email'];
			$user_model->salt     = $dynamic_salt;
			$user_model->pass     = $crypted_pass;
            $user_model->gender = $_POST['gender'];
            $user_model->date_birthday = strtotime($_POST['bdate']);
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

		public function action_register()
		{
			if(!\Request::current()->is_ajax())
			{
				\Assets::js('register',base_UI.'js/Auth/register.js');
				$this->response->body($this->template->fetch('Auth/register.tpl'));
			}
			else
			{

                $attrs = ['email','pass','pass2','first_name','bdate'];
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