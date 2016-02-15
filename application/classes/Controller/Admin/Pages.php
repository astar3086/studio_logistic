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
class Pages extends System
{

    /**
     *
     */
    public function action_index()
    {

        Assets::js('datatable_jquery',base_UI.'js/plugins/datatables/jquery.dataTables.js');
        Assets::js('datatable',base_UI.'js/plugins/datatables/dataTables.bootstrap.js');

        Assets::js('icheck',base_UI.'js/plugins/iCheck/icheck.min.js');

        $this->response->body( $this->template->fetch('admin/pages/Index.tpl') );
    }

    public function action_Add()
    {
            $this->addCKEditor();
            $this->addBootstrapModal();
            $this->addSelect2();

            $PageTypes = \Model\PageType::model()->findAll();

            $this->template->assign(
                [
                    'PageTypes'   => $PageTypes,
                ]
            );

            //Alerts BootBox
            \Assets::js('BootBox', base_UI.'libs/BootBox/bootbox.js');
            $this->response->body($this->template->fetch('admin/pages/add.tpl'));
    }

    public function action_Edit()
    {
        if($item_id = \Utils\Protect::Validate($this->request->param('id'),'int'))
        {

            \Assets::js('sight', base_UI.'js/admin/pages/Edit.js');
            $this->addCKEditor();
            $this->addBootstrapModal();
            $this->addSelect2();

            //Alerts BootBox
            \Assets::js('BootBox', base_UI.'libs/BootBox/bootbox.js');

            //Item Data
            $data_item = \Model\Pages::model()->findByPk( $item_id );
            $PageTypes = \Model\PageType::model()->findAll();

            $this->template->assign(
                [
                    'data'   => $data_item,
                    'PageTypes'   => $PageTypes,
                ]
            );

            $this->response->body($this->template->fetch('admin/pages/edit.tpl'));
        }
    }

    /**
     *
     */
    public function action_AddData()
    {
        $this->response->headers('Content-Type', 'application/json');
        $user_id    = \Registry::getCurrentUser()->iduser;

        $item = new \Model\Pages();
        $zone_info = $_POST;

        if ( $zone_info ){
            $item->title        = $zone_info['title'];
            $item->alias        = $zone_info['alias'];
            $item->description  = $zone_info['description'];
            $item->main_text    = $zone_info['main_text'];
            $item->idpage_type  = $zone_info['page_type'];

            if(!$item->save())
            {
                $this->response->body(json_encode(['code' => -1]));
                return;
            }

            $this->response->body(json_encode(['code' => 0]));
        }

    }

    /**
     *
     */
    public function action_EditData()
    {

        if(false !== ($item_id = Protect::Validate( $this->request->param('id'),'int' )))
        {
            $this->response->headers('Content-Type', 'application/json');
            $user_id    = \Registry::getCurrentUser()->iduser;

            $item = \Model\Pages::model()->findByPk( $item_id );
            $zone_info = $_POST;

            if ( $zone_info ){
                $item->title        = $zone_info['title'];
                $item->alias        = $zone_info['alias'];
                $item->description  = $zone_info['description'];
                $item->main_text    = $zone_info['main_text'];
                $item->idpage_type    = $zone_info['page_type'];

                if(!$item->save())
                {
                    $this->response->body(json_encode(['code'=>-1]));
                    return;
                }
            }

            $this->response->body(json_encode(['code'=>0]));
        }

    }

    public function action_delete()
    {

        if(false !== ($id = Protect::Validate( $_POST['id'],'int' )))
        {
            $status = false;
            $User= \Model\Pages::model()->findByPk( $id );

            if (  \Model\Pages::model()->deleteAllByAttributes( ['idpages' => $id] ) ){
                $status = 0;
            }

            $this->response->body(json_encode(['code'=>$status]));
            return true;
        }
    }

    public function action_GetJson()
    {
        $data  = \Model\Pages::model()
            ->with('idpageType')->findAll();

        $access = new \Auth\Access(\Registry::getCurrentUser()->access_level);
        if($access->get(\Auth\Access::User_Is_Admin))
        {
            $aoColumnsData = [];

            if ( !$data ){
                $this->response->body(json_encode(['aaData' => $aoColumnsData]) );
                return;
            }

            /** @var $item User */
            foreach($data as $key=>$item)
            {

                $tmp = [
                    'id'            => $item->idpages,
                    'title'         => $item->title,
                    'description'   => $item->description,
                    'type'          => $item->idpageType->name
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