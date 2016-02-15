<?php

namespace Controller;

use \smarty\View;
use \Model\User;
use \Model\ULogin;



class Index extends \Builder
{
	/**
	 * @var \smarty\View
	 */
	public $template;
    public $navigation = 30;
    private $formula_id = 5;

	public function action_index()
	{

        $user_id    = \Registry::getCurrentUser()->iduser;
        $services     = $this->getServices();

        $this->template->assign([
            'services'   => $services,
        ]);

        $this->response->body($this->template->fetch('main.tpl'));

	}


    public function getServices()
    {

        $data = \Model\Services::model()->with(['serviceChilds'])
            ->findAllByAttributes(['parent_id' => 0]);

        return $data;
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

            $user_model = new User();
            $user_model->login = $user['login'];
            $user_model->first_name  = $user['first_name'];
            $user_model->email    = $user['email'];

            $access_level = new \Auth\Access();
            $access_level->set(\Auth\Access::User_Login);
            $user_model->access_level =  $access_level->getValue();

            if(!$user_model->save())
            {
                throw new \Kohana_Database_Exception('Unable to save user model');
            }

            $ULogin          = new ULogin();
            $ULogin->network = $user['network'];
            $ULogin->uid     = $user['uid'];
            $ULogin->profile     = $user['identity'];
            $ULogin->user_id = $user_model->id;

            if(!$ULogin->save())
            {
                $this->response->body('Unable to save social network data');
            }

            \Auth\Base::startSession($ULogin['user']);
            $this->redirect(\Route::get('pages')->uri(['controller'=>'Map','action'=>'Add']));
        }
        else
        {
            \Auth\Base::startSession($ULogin['user']);
            $this->redirect(\Route::get('pages')->uri(['controller'=>'Map','action'=>'Add']));
        }
    }

}