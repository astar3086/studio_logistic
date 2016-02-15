<?php
    namespace Controller;

    use Model\User;
    use File;
    use Image;
    use Upload;
    use Text;

    use \smarty\View;
    use \Pagination;
    use \Request;

    /**
     *
     * @package Controller
     */
    class Catalog extends \Builder
    {

        public $per_page = 3;

        // Каталог транспортных компаний
        public function action_transportCatalog()
        {
            $tplObj = \smarty\View::factory('catalog');
            $page = $this->request->post('page');

            $offset = $this->request->post('offset');
            $is_pagination = $this->request->post('is_pagination');

            $pagination = false;
            if ( $is_pagination )
            {
                $data = \Model\TransportCompany::model()->count();
                $p_factory = \Pagination::factory(array('total_items' => $data));

                $tplObj->assign([
                    'pagination' => $p_factory,
                ]);

                $pagination = $tplObj->fetch('catalog'.DS.'pagination.tpl');
            }

            $offset = $this->per_page * ( $page - 1) ;
            if( Request::current()->is_ajax() )
            {

                $criteria = (new \DBCriteria());
                $criteria->limit = $this->per_page;
                $criteria->offset = $offset;

                $data = \Model\TransportCompany::model()->with(['companyAttacheds'])
                    ->findAll( $criteria );

                $tplObj->assign([
                    'data' => $data,
                ]);

                $this->response->body(json_encode(
                    [
                        'pagination' => $pagination,
                        'content' => $tplObj->fetch('catalog'.DS.'transport.tpl')
                    ]
                ));
            }

        }


    }
