<?php
    namespace Controller;

    use Model\User;
    use Model\UserConfig;
    use File;
    use Image;
    use Upload;
    use Text;

    use \smarty\View;
    use \Pagination;
    use \Request;

    /**
     * Class Pages
     *
     * @package Controller
     */
    class Pages extends \Builder
    {

        private $limit = 200;
        public $pagination;
        public $limit_navigation = 10;

        public function action_display()
        {

            $user_id    = \Registry::getCurrentUser()->iduser;
            if($item_id = \Utils\Protect::Validate($this->request->param('id'),'int'))
            {
                \Assets::js('page1', base_UI.'js/pages/page.js');
                $page = \Model\Pages::model()->findByPk( $item_id  );

                $this->template->assign([
                    'page' => $page

                ]);

                $this->response->body($this->template->fetch('pages.tpl'));

            } else if ($alias = \Utils\Protect::Validate($this->request->param('alias'),'string')){

                /**@var \Model\Item $data*/
                \Assets::js('page1', base_UI.'js/pages/page.js');
                $page = \Model\Pages::model()->findByAttributes( ['alias' => $alias] );

                $this->template->assign([
                    'page' => $page

                ]);

                $this->response->body($this->template->fetch('pages.tpl'));
            }

        }


    }
