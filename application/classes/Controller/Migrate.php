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
     * Перенос таблиц
     * @package Controller
     */
    class Migrate extends \Builder
    {

        public $secret = 'migrate';
        public $per_limit = 100; // По 100 штук за раз

        public $table_from1 = '\Model\Places3';
        public $table_from2 = 'Places3';
        public $table_to = 'place_service';

        public $service_type = [
            'Marinetrafic'       => '12',
            'Container Terminal' => '10',
            'Sea Rates'          => '11',
            'River'              => '13',
            'Marinas'            => '14',
            'Port'               => '1',
        ];

        public function action_migrate()
        {

            $count = $this->migrateCount();
            $model = new $this->table_from1();
            $connection = $model->getDbConnection();
            //$count = 500;

            $transaction=$connection->beginTransaction();
            try
            {
                // Переносим таблицу порциями
                for ( $offset = 0; $offset < $count; $offset = $offset + $this->per_limit )
                {
                    $sql="SELECT * FROM ".$this->table_from2 . " LIMIT " .
                        $this->per_limit . " OFFSET ". $offset;

                    $command = $connection->createCommand($sql);
                    $dataReader = $command->queryAll();

                    // TODO Insert Query
                    /*$this->migrate = [
                        'title' => 'name',
                        'lat'   => 'lat',
                        'lng'   => 'lng',
                    ];*/

                    // Place3 -> places_info
                    /*$this->migrate = [
                        'id'            => 'idplaces',
                        'web'           => 'url',
                        'type_of_port'  => 'place_type',
                        'connection'    => 'connection',
                        'phone'         => 'phone',
                        'fax'           => 'fax',
                        'email'         => 'email',
                        'country'       => 'country',
                    ];*/

                    // places_attr_varchar
                    /*$this->migrate = [
                        'port_authority' => '7',
                        'code'           => '2',
                        'port_type'      => '8',
                        'port_size'      => '9',
                        'max_draft'      => '10',
                        'icon'           => '1',
                    ];*/

                    // place_service
                    $this->migrate = [
                        'id' => 'idplaces',
                    ];

                    $insert_s = [];
                    $ins_val = implode(",", array_values( $this->migrate ));
                    $insert = 'INSERT INTO '.$this->table_to.'
                                    ( idservice_type, idplaces )
                                VALUES ';

                    // Variant 1
                    /*foreach ( $dataReader as $key => $valueRead )
                    {
                        $to_sql = [];
                        //if ( empty( $valueRead['code']) ) continue;

                        foreach ( $this->migrate as $column => $value2 )
                        {
                            if ( array_key_exists($column, $valueRead) )
                            {

                                // TODO Filter Data
                                $filtered = addslashes($valueRead[$column]);
                                $filtered = str_replace(',','.',$filtered);
                                $to_sql[] = "'".$filtered."'";

                            }
                        }

                        if ( $to_sql )
                        {
                            //$to_sql[] = "'2'";
                            $to_sql = implode(",", $to_sql);
                            $insert_s[] = '('.$to_sql.')';
                        }
                    }*/

                    // Variant 2
                    //$insert_s = $this->insertAttrVarchar( $dataReader, $connection );
                    $insert_s = $this->insertServices( $dataReader, $connection );

                    if ( $insert_s ){
                        $insert .= implode(",", $insert_s);
                        unset($dataReader);

                        /*echo $insert;
                        exit;*/

                        $command = $connection->createCommand( $insert );
                        $command->execute();
                    }

                }

                $transaction->commit();
            }
            catch(Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
            {
                $transaction->rollback();
            }

            //echo $insert;
            exit;

        }

        public function migrateCount()
        {

            $criteria    = (new \DBCriteria());
            $criteria->select = ' count(id) as count_id ';

            $table = $this->table_from1;
            $data = $table::model()->find( $criteria );
            return $data->count_id;

        }

        // Таблица Place Services.
        public function insertServices( $dataReader, $connection )
        {

            $insert = '';
            $insert_s = [];
            $to_sql = [];

            foreach ( $dataReader as $key => $valueRead )
            {
                if ( $valueRead['port_type'] == 'River Port'){
                    $vals_set = "River";
                } elseif ( $valueRead['type_of_port'] == 'Port' && !empty($valueRead['type']) ){
                    $vals_set = $valueRead['type'];
                } elseif ( !empty($valueRead['type_of_port']) ) {
                    $vals_set = $valueRead['type_of_port'];
                }

                $to_sql = [$this->service_type[ $vals_set ], $valueRead['id']];

                if ( $to_sql )
                {
                    $to_sql = implode(",", $to_sql);
                    $insert_s[] = '('.$to_sql.')';
                }
            }

            return $insert_s;

        }

        // Таблица Place Attr Varchar.
        public function insertAttrVarchar( $dataReader, $connection )
        {

            $insert = '';
            $insert_s = [];
            $to_sql = [];

            foreach ( $dataReader as $key => $valueRead )
            {

                foreach ( $this->migrate as $column => $value2 ) {

                    if ( !empty($valueRead[$column]) )
                    {
                        $filtered = addslashes($valueRead[$column]);
                        $filtered = str_replace(',','.',$filtered);
                        $to_sql = [$valueRead['id'], $value2, "'".$filtered."'"];

                        if ($to_sql) {
                            $to_sql = implode(",", $to_sql);
                            $insert_s[] = '(' . $to_sql . ')';
                        }
                    }
                }
            }

            return $insert_s;

        }


    }
