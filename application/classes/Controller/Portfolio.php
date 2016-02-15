<?php
    namespace Controller;

    use Model\User;
    use Model\Messages;
    use Model\Countries;
    use Model\Favorites;
    use Model\Complaint;
    use Model\Reports;
    use Model\UserConfig;
    use Model\Item;
    use Model\Visits;
    use Model\ItemCoordinates;
    use Model\Location;
    use File;
    use Image;
    use Upload;
    use Text;

    use \Smarty\View;
    use \Pagination;
    use Utils\Protect;
    use \Request;

    /**
     * Class Portfolio
     *
     * @package Controller
     */
    class Portfolio extends \Builder
    {

        private $limit = 200;
        public $pagination;
        public $limit_navigation = 10;

        /**
         *
         */
        public function action_main()
        {

            $user = \Session::instance()->get('UloginData');
            $user_id    = \Registry::getCurrentUser()->id;

            $this->addSelect2();
            \Assets::js('page2', base_UI.'js/pages/portfolio.js');

            if( $user_id )
	        {
		        /** @var $data \Model\Item */
		        $data = User::model()->findByPk( $user_id );
                $countries = Countries::model()->findAll();

                $birth_dates = new \stdClass();
                $current_dates = new \stdClass();

                $months = [];
                for ( $m = 1; $m <= 12; $m++ ) {
                    $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                    $months[$m]  = $month;
                }

                $birth_dates->day   = range(1, 31);
                $birth_dates->month = $months;
                $birth_dates->year  = range(2015, 1950);

                $current = strtotime( $data->date_birthday );
                $current_dates->day   = date("j", $current);
                $current_dates->month = date("n", $current);
                $current_dates->year  = date("Y", $current);

		        if(!is_null($data))
		        {

			        $this->template->assign([
                        'birth_dates'   => $birth_dates,
                        'current_dates' => $current_dates,
                        'countries'     => $countries,
				        'user'          => $data,
			        ]);

			        $this->response->body($this->template->fetch('portfolio/display.tpl'));
		        }
		        else
		        {
			        $this->response->body($this->template->fetch('404.tpl'));
		        }

	        } else
            {
                $this->response->body($this->template->fetch('404.tpl'));
            }


        }

        public function action_complaint()
        {

            if(Request::current()->is_ajax())
            {
                if($user_id = \Utils\Protect::Validate($this->request->post('user_id'),'int'))
                {

                    $complaint = $_POST['complaint'];

                    if ( $complaint == 'reason' ){
                        if( empty( $_POST['reason'] ) )
                        {
                            $this->response->body(json_encode(['code'=> 'Please Enter Reason!']));
                            return;
                        }

                        $data                    = new \Model\Reports();
                        $data->id_user           = $user_id;
                        $data->id_target         = $_POST['target_id'];
                        $data->target_type       = $_POST['target_type'];
                        $data->message           = $_POST['reason'];

                    }  else {

                        $reason = $_POST['reason'];

                        $data2 = Complaint::model()->findByPk( $reason );

                        $data                    = new \Model\Reports();
                        $data->id_user           = $user_id;
                        $data->id_target         = $_POST['target_id'];
                        $data->target_type       = $_POST['target_type'];
                        $data->message           = $data2->complaint;
                    }


                    if(!$data->save(false))
                    {
                        $this->response->body(json_encode(['code'=> 'Error!']));
                        return;
                    }

                    $this->response->body(json_encode(['code'=> 'Your message has been sent!']));
                    return;
                }
            }

        }

        /**
         *
         */
        public function action_viewMessages()
        {

            $user_id    = \Registry::getCurrentUser()->id;
            \Assets::js('page', base_UI.'js/pages/portfolio.js');

            if ( $user_id ){
                /** @var $data \Model\Item */
                $data = User::model()->findByPk( $user_id );

                $read_find = 0;
                if( $this->request->post('read') ) {
                    $read_find = 1;
                }

                $condition = ['id_user' => $user_id, 'read' => $read_find];
                $messages  = Messages::model()->findAllByAttributes($condition);
                Messages::model()->updateAll(['read' => 1], 'id_user = '.$user_id);
            }


            if(!is_null($data))
            {

                $this->template->assign([
                    'mess'    => $messages,
                    'user'    => $data
                ]);

                $this->response->body($this->template->fetch('portfolio/view_messages.tpl'));
            }
            else
            {
                $this->response->body($this->template->fetch('404.tpl'));
            }

        }


        /**
         *
         */
        public function action_view()
        {

            $user = \Session::instance()->get('UloginData');

            if($user_id = \Utils\Protect::Validate($this->request->param('id'),'int'))
            {
                /** @var $data \Model\Item */
                $data = User::model()->findByPk( $user_id );
                $countries = Countries::model()->findAll();
                $complaints  = \Model\Complaint::model()->findAll();

                \Assets::js('page', base_UI.'js/pages/portfolio.js');

                $birth_dates = new \stdClass();
                $current_dates = new \stdClass();

                $months = [];
                for ( $m = 1; $m <= 12; $m++ ) {
                    $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                    $months[$m]  = $month;
                }

                $birth_dates->day   = range(1, 31);
                $birth_dates->month = $months;
                $birth_dates->year  = range(2015, 1950);

                $current = strtotime( $data->date_birthday );
                $current_dates->day   = date("j", $current);
                $current_dates->month = date("n", $current);
                $current_dates->year  = date("Y", $current);

                if(!is_null($data))
                {

                    $this->template->assign([
                        'birth_dates'   => $birth_dates,
                        'complaints'    => $complaints,
                        'current_dates' => $current_dates,
                        'countries'     => $countries,
                        'user'          => $data,
                    ]);

                    $this->response->body($this->template->fetch('portfolio/view_user.tpl'));
                }
                else
                {
                    $this->response->body($this->template->fetch('404.tpl'));
                }

            }

        }

        public function action_userConfig()
        {

            //Alerts BootBox
            \Assets::js('BootBox', base_UI.'libs/BootBox/bootbox.js');
            \Assets::js('page', base_UI.'js/pages/user_config.js');

            $user_id = \Registry::getCurrentUser()->id;
            $data = $this->dataConfig( $this->limit_navigation );

            $this->template->assign([
                'data_config'   => $data,
            ]);

            $this->response->body($this->template->fetch('portfolio/config_list.tpl'));
        }

        public function dataConfig( $limit = false )
        {
            $user_id  = \Registry::getCurrentUser()->id;

            $data = \Model\UserConfig::model()
                ->findByAttributes(['user_id'=>$user_id]);

            if ( !$data ){
                $data = new UserConfig();
                $data->save();
            }

            return $data;
        }

        /**
         *
         */
        public function action_changeConfig()
        {

            $user       = \Session::instance()->get('UloginData');
            $user_id    = \Registry::getCurrentUser()->id;

            if( Request::current()->is_ajax() )
            {

                if($item_value = \Utils\Protect::Validate(  $this->request->post('config') ,'int' ))
                {

                    $param = $this->request->post('param');

                    $config = userConfig::model()
                        ->findByAttributes( ['user_id' => $user_id] );

                    $config->$param = $item_value;
                    $this->response->body(json_encode( [] ));

                }

            }
        }

        public function Pagination()
        {
            $criteria    = (new \DBCriteria());
            $criteria->select    = 'count(it.id) as count_sights';
            $criteria->condition = 'aid = :user_id';

            $user_id = \Registry::getCurrentUser()->id;
            $criteria->params = [':user_id' => $user_id];

            $data = \Model\Item::model()->find( $criteria );
            $this->pagination = Pagination::factory(array('total_items' => $data->count_sights));

        }

        /**
         *
         */
        public function action_saveData()
        {

            $user = \Session::instance()->get('UloginData');
            $user_id    = \Registry::getCurrentUser()->id;

            if( $user_id )
            {
                /** @var $data \Model\Item */
                $data = User::model()->findByPk( $user_id );

                $keys = array_keys( $_POST );

                foreach( $keys as $key )
                {

                    $value = $_POST[ $key ];
                    if ( $value != '' ){

                        if ( $key == "month" ||  $key == "year" ){
                            continue;
                        }

                        if ( $key == "pass"){

                            $dynamic_salt = \Utils\Math::rand();
                            $pass = $_POST['password'].\Cookie::$salt;
                            $value = \Utils\Protect::Crypt($pass,$dynamic_salt);
                            $data->salt = $dynamic_salt;

                        }

                        if ( $key == "day" ){

                            $date_birthday = date('Y-m-d', mktime(0,0,0,$_POST[ 'month' ], $_POST[ 'day' ], $_POST[ 'year' ]));
                            $data->date_birthday = $date_birthday;

                        } else {

                            $data->$key = $value;

                        }


                    }

                }

                if ( !empty($_FILES['photo']['name']) ){
                    $filename    = $this->_save_image( $_FILES['photo'] );
                    $data->photo = $filename;
                }

                if( !$data->save() )
                {
                    $this->response->body('Error User Data');
                }
                else
                {
                    $this->redirect(\Route::get('pages')
                            ->uri(['controller'=>'Portfolio','action'=>'main']));
                }

            }

        }

        // -- Delete User Account
        public function action_delete()
        {

            if(\Request::current()->is_ajax() )
            {
                $user_id  = \Registry::getCurrentUser()->id;
                $value    = $this->request->post('value');
                $status   = false;

                if ( (int)$value == 1 ){
                    $User= \Model\User::model()->findByPk( $user_id );

                    if ( $User->delete() ){
                        $status = true;
                    }

                    if ( $status ){
                        $this->response->body(json_encode(['code' => 1]));
                    } else {
                        $this->response->body(json_encode(['code' => 0]));
                    }
                } else {
                    $User= \Model\User::model()->findByPk( $user_id );
                    $User->access_level = 0; // Deleted

                    if ( $User->save() ){
                        $this->response->body(json_encode(['code' => 1]));
                    } else {
                        $this->response->body(json_encode(['code' => 0]));
                    }
                }

            }

        }

        public function emptyDirectory($dir){
            return (($files = @scandir($dir)) && count($files) <= 2);
        }

        public function removeMedia( $item_id, $user_id )
        {

            $main_path = $_SERVER['DOCUMENT_ROOT'].DS.'Uploads'.DS.'Gallery'.DS;
            $path_item      = $main_path.$user_id.DS.$item_id;

            if ( !is_dir($path_item) ){
                return false;
            }

            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path_item,
                    \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach($files as $fileInfo) {
                $filePath = $fileInfo->getPathname();

                //if(!$fileInfo->isDot()) {
                if($fileInfo->isFile()) {
                    unlink($filePath);
                }
                else if($fileInfo->isDir()) {
                    if($this->emptyDirectory($filePath)) {
                        rmdir($filePath);
                    }
                    else {
                        $this->delete($filePath);
                        rmdir($filePath);
                    }
                }
                // }
            }
            rmdir($path_item);
        }

        protected function _save_image( $image )
        {
            $user_id    = \Registry::getCurrentUser()->id;

            if (
                ! Upload::valid($image) OR
                ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
            {
                return FALSE;
            }

            $directory = $_SERVER['DOCUMENT_ROOT'].'/Uploads/Photo/'.$user_id.'/';
            $thumbnail = $_SERVER['DOCUMENT_ROOT'].'/Uploads/Photo/'.$user_id.'/thumbnail/';

            $this->create_dir( $directory, '' );
            $this->create_dir( $directory, 'thumbnail' );

            $file       = Upload::save($image, NULL, $directory);
            $file_clear = str_replace( '\\', '/', $file );
            $filename   = str_replace( $directory, '', $file_clear );

            // -- Resize
            if ( file_exists( $file ) )
            {
                Image::factory( $file )
                    ->resize(100, 100, Image::AUTO)
                    ->save( $thumbnail.$filename );

                return $filename;
            }

            return FALSE;
        }

        public function create_dir( $path, $version_dir ) {

            if (!is_dir( $path.$version_dir )) {
                mkdir( $path.$version_dir, 0755, true);
            }

            return true;
        }

        /**
         *
         */
        public static function sendEmail( $subject, $user_send, $message )
        {
            $config_email = \Kohana::$config->load('email');
            \Email::connect( $config_email );

            $from = $config_email->get('admin_email');
            $send = \Email::send( $user_send, $from, $subject, $message, $html = true );
        }

    }
