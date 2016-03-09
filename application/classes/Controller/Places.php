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
class Places extends \Builder
{

    public $exclude = [
        10 => [56, 647, 589],
        11 => [631, 598, 3117],
        13 => [3757, 3213, 2433],
        14 => [668],
        2  => [5965, 4349, 4212, 4201,4280, 3992, 4252, 4056, 4056],
        999 => [11691,7284, 7499, 12799, 12907, 4365]
    ];

    public function action_testing()
    {

        $id_service = 1;
        $limit      = 10;
        $offset     = 0;

        $parent = \Model\Services::model()->findByPk( $id_service );
        $childs = [$id_service];

        // Child Services
        if ( $parent->parent_id == 0 )
        {
            $child_serv = \Model\Services::model()
                ->getListArray( $id_service );

            if ( $child_serv )
                $childs = array_keys( $child_serv );
        }

        $childs_sql = "(".implode( ",", $childs ).")";

        // Find Places
        $criteria = (new \DBCriteria());
        $criteria->limit = $limit;

        if ( $offset ) $criteria->offset = $offset;
        $data = \Model\Places::model()
            ->with(array(
                'placeService'=>array(
                    'select'=>false,
                    'joinType'=>'INNER JOIN',
                    'condition'=>' placeService.idservice_type IN '.$childs_sql,
                )))->findAll( $criteria );


        $this->template->assign([
            'data'   => $data,
        ]);

        $this->response->body($this->template->fetch('testing.tpl'));

    }

    // Маркеры по типу
    public function action_getByService()
    {

        $id_service = $this->request->post('id');
        $limit      = $this->request->post('limit');
        $offset     = $this->request->post('offset');

        if( Request::current()->is_ajax() && $id_service )
        {

            $criteria = (new \DBCriteria());
            $parent = \Model\Services::model()->findByPk( $id_service );
            $childs = [$id_service];

            // Child Services
            if ( $parent->parent_id == 0 )
            {
                $child_serv = \Model\Services::model()
                    ->getListArray( $id_service );

                if ( $child_serv )
                    $childs = array_keys( $child_serv );
            }

            $childs_sql = "(".implode( ",", $childs ).")";

            // Find Places
            $criteria = (new \DBCriteria());
            if ( $limit ) {
                $criteria->limit = $limit;
            }  else {
                $criteria->limit = 400;
            }

            if ( $offset ) $criteria->offset = $offset;
            $data = \Model\Places::model()
                ->with(array(
                    'placeService'=>array(
                        'select'=>false,
                        'joinType'=>'INNER JOIN',
                        'condition'=>' placeService.idservice_type IN '.$childs_sql,
                    )))->findAll( $criteria );

            $result = []; $exclude = [];
            foreach ( $this->exclude as $key => $value )
            {
                $exclude = array_merge( $exclude, $value );
            }

            foreach ( $data as $key => $value )
            {

                if ( !in_array($value->idplaces, $exclude) )
                {
                    $service_type = $value->placeService->idservice_type;

                    $push = [
                        'item_id'      => $value->idplaces,
                        'center_lat'   => $value->lat,
                        'center_lng'   => $value->lng,
                        'service_type' => $service_type,
                    ];

                    $result[] = $push;
                }
            }

            $this->response->body(json_encode(
                [
                    'data' => $result,
                ]
            ));
        }

    }

    // Маркеры по типу
    public function action_getByName()
    {

        $search = $this->request->post('search');
        if(Request::current()->is_ajax() && $search)
        {

            $criteria = (new \DBCriteria());
            $criteria->addSearchCondition('name', $search, true, 'AND', 'LIKE');
            $data = \Model\Places::model()->findAll( $criteria );

            $result = [];
            foreach ( $data as $key => $value ){
                $result[ $key ]['item_id']    = $value->idplaces;
                $result[ $key ]['center_lat'] = $value->lat;
                $result[ $key ]['center_lng'] = $value->lng;
            }

            $this->response->body(json_encode(
                [
                    'data' => $result,
                ]
            ));
        }

    }

    public function action_getPlaceInfo()
    {

        $id_place = $this->request->post('id');
        if(Request::current()->is_ajax() && $id_place)
        {

            $criteria = (new \DBCriteria());
            $criteria->condition
                = '';

            $data = \Model\PlacesInfo::model()
                ->with(array(
                    'idplaces0'=>array(
                        'select'=>'idplaces0.name',
                        'joinType'=>'INNER JOIN',
                    )))->findByAttributes( ['idplaces' => $id_place] );

            $tplObj = \smarty\View::factory('places');

            $tplObj->assign([
                'data' => $data,
            ]);

            $this->response->body(json_encode(
                [
                    'content' => $tplObj->fetch('places'.DS.'place_info.tpl')
                ]
            ));
        }

    }

}