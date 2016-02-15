<?php

namespace Controller;

//use \Smarty\View;
use \Model\Item;
use \Model\User;
use \Model\ItemCores;
use Model\GalleryImages;



class Search extends \Builder
{
	/**
	 * @var \smarty\View
	 */
	public $template;
    public $limit = 10;

	public function action_index()
	{

        $user_id    = \Registry::getCurrentUser()->iduser;
        $category   = $this->request->post('category');

        if(!($search = \Utils\Protect::Validate(  $this->request->post('search') ,'string' )))
        {
            $search = \Utils\Protect::Validate(  $this->request->query('search') ,'string' );
        }

        if( !empty( $search ) )
        {
            switch ( $category ){
                case '1': $this->findAll( $search );     break;
                default: $this->findAll( $search ); $category = 1;
            }

        }

        $this->template->assign([
            'category' => $category,
            'search'   => $search,
        ]);

          $this->response->body($this->template->fetch('search/results.tpl'));

	}

    public function findImages( $search )
    {

        $user_id  = \Registry::getCurrentUser()->iduser;
        $user     = \Model\User::model()->findByPk( $user_id  );

        $criteria = (new \DBCriteria(array(
            'condition' => " description LIKE :match OR
                             main_text LIKE :match OR
                            title LIKE :match OR ",
            'params'    => array(':match' => "%$search%")
        )));

        $criteria->limit = $this->limit;
        $data = \Model\Pages::model()
            ->with('idpageType')->findAll( $criteria );

        $this->template->assign([
            'results'     => $data,
            'count_find'  => count($data)
        ]);
    }

    public function findAll( $search )
    {
        $this->findImages( $search );
    }


}