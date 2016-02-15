<?php
    namespace Controller\Admin;

	use Auth\Base;
    use Assets;
    use Builder\System;
	use Model\ULogin;
	use Model\User;
    use Utils\Url;

    use Utils\Math;
    use Utils\Protect;

	/**
	 * Class Auth
	 * @package Controller
	 */
	class Users extends System
    {

        /**
         *
         */
        public function action_index()
        {

            Assets::js('datatable_jquery',base_UI.'js/plugins/datatables/jquery.dataTables.js');
            Assets::js('datatable',base_UI.'js/plugins/datatables/dataTables.bootstrap.js');

            Assets::js('icheck',base_UI.'js/plugins/iCheck/icheck.min.js');
            $this->response->body( $this->template->fetch('admin/users/Index.tpl') );
        }

        public function action_Edit()
        {

            if (\Request::current()->is_ajax())
            {
                $this->saveEditData();
            }
            else
            {
                $access = new \Auth\Access(\Registry::getCurrentUser()->access_level);

                Assets::js('login',base_UI.'js/Admin/Users/Edit.js');
                Assets::js('BootBox', base_UI.'libs/BootBox/bootbox.js');

                if(false !== ($user_id = Protect::Validate($this->request->param('id'),'int')))
                {
                    $data = User::model()->findByPk( $user_id );

                    $this->template->assign([
                        'data' => $data ]);

                    $this->response->body( $this->template
                        ->fetch('admin/users/Edit.tpl') );
                }
                else
                {
                    throw new \HTTP_Exception_500('Id is not valid');
                }
            }

        }

        public function saveEditData()
        {

            if(false !== ($user_id = Protect::Validate($this->request->param('id'),'int')))
            {
                /** @var $data \Model\Item */
                $data = User::model()->findByPk( $user_id );

                $keys = array_keys( $_POST );
                foreach( $keys as $key )
                {
                    $value = $_POST[ $key ];
                    if ( !empty( $value ) ){

                        if ( !empty( $_POST['pass'] )){

                            $dynamic_salt = \Utils\Math::rand();
                            $pass = $_POST['pass'].$dynamic_salt;
                            $value = \Utils\Protect::Crypt($pass,$dynamic_salt);
                            $data->salt = $dynamic_salt;

                        }

                        $data->$key = $value;
                    }
                }

                if( $data->save() )
                {
                    $this->response->body(json_encode([ 'code' => 0 ]));
                }
                else
                {
                    throw new \HTTP_Exception_500('Id is not valid');
                }
            }
        }

        public function action_delete()
        {

            if(false !== ($id = Protect::Validate($_POST['id'],'int')))
            {
                $status = false;
                $User= \Model\User::model()->findByPk( $id );
                //$this->delete_credit( $id );

                if ( $User->delete() ){
                    $status = 0;
                }

                $this->response->body(json_encode(['code'=>$status]));
                return true;
            }
        }

        public function delete_credit( $user_id )
        {

            $status = false;
            $data= \Model\UserCredit::model()
                ->findByAttributes( array("iduser" => $user_id) );

            if ( $data )
            {
                \Model\UserCredit::model()->deleteAllByAttributes( ['iduser' => $user_id] );
                $this->removeMedia( $user_id );
            }

            return $status;
        }

        public function removeMedia( $user_id )
        {

            $main_path = $_SERVER['DOCUMENT_ROOT'].DS.'Uploads'.DS.'Gallery'.DS;
            $path_item      = $main_path.$user_id;

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

        public function action_GetJson()
        {

            $data = User::model()->findAll();

            $access = new \Auth\Access(\Registry::getCurrentUser()->access_level);
            if($access->get(\Auth\Access::User_Is_Admin))
            {
                $aoColumnsData = [];
                /** @var $item User */
                foreach($data as $item)
                {
                    $currentUserAccess = new \Auth\Access($item->access_level);
                    $tmp = [
                        'id'       => $item->iduser,
                        'fio'      => $item->first_name,
                        'email'    => $item->email,
                        'Access'   => ($currentUserAccess->get(\Auth\Access::User_Login)) ? 'Yes' : 'No',

                    ];
                    $aoColumnsData[] = $tmp;
                }
                $this->response->body(json_encode(['aaData' => $aoColumnsData]));
            }
            else
            {
                throw new \HTTP_Exception_403('Admin Only');
            }
        }

	}