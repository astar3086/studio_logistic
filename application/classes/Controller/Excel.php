<?php

namespace Controller;

use \Model\User;
use \Model\ULogin;


/**
 * Class Excel
 * Можно вставлять в несколько связанных таблиц
 * Для каждой таблицы своя функция обработки
 * @package Controller
 */
class Excel extends \Builder
{
    public $sheetnumber = 5;        // Номер листа
    public $ignored     = 2;        // Пропускаем строки
    public $maxId       = 0;        // Последний ID в главной таблице
    public $testMode    = false;    // Тестовый режим включен TRUE!!!

    public $per_limit   = 10000;    // Итерация
    public $limit       = 10000;    // Занести записей

    // Главная таблица
    public $show_table = 'places_attr_varchar';

    // Main Model for Main Table
    public $model = '\Model\Places';

    // Для каждой таблицы функция
    public $table_to = [
        // Main Function
        'sqlPlaces'      => 'places',
        // Standart Related Function
        'sqlRelated'     => 'places_info',
        // Other Related Functions
        'sqlAttrInt'     => 'places_attr_int',
        'sqlAttrVarchar' => 'places_attr_varchar',
        'sqlService'     => 'place_service',
    ];

    // Поля которые проверяются на пустоту
    public $empty_ckeck =
        [
            'E',
        ];

    // Дополнительные поля
    // Соответсвуют полям в $source_tables
    public $extends =
        [
            'places_info' => [
                'parent1'    => '',
                'include1'   => 'Airport',
            ]
        ];

    // Все поля в Excel
    public $source =
        [
            'A' => '', // пропустить
            'B' => 'country',
            'C' => 'region',
            'D' => 'city',
            'E' => 'name',
            'F' => 'address',
            'G' => 'phone',
            'H' => 'email',
            'I' => 'url',
            'J' => '', // координаты
            'K' => '3',
            'L' => '4',
            'M' => '5',
            'N' => '6',
        ];

    // Поля по таблицам
    public $source_tables =
        [
            // Main Table
            'places' => [
                'E' => 'name',
                'J' => '', // координаты
            ],
            // Related Table
            'places_info' => [
                'parent1' => 'idplaces', // ID Main
                'include1' => 'place_type', // Varchar Field
                'B' => 'country',
                'C' => 'region',
                'D' => 'city',
                'F' => 'address',
                'G' => 'phone',
                'H' => 'email',
                'I' => 'url',
            ],
            'places_attr_int' => [
                'M' => '5',
                'N' => '6',
            ],
            'places_attr_varchar' => [
                'K' => '3',
                'L' => '4',
            ],
        ];

    // Транзакция
    public function action_index()
	{

        $model = new $this->model;
        $this->setMaxId( $model );

        $spreadsheet = \Spreadsheet::factory(
            array(
                'filename' => 'Excel/base.xlsx'
            ), FALSE)->load();

        $spreadsheet->set_active_worksheet( $this->sheetnumber );
        $return = $spreadsheet->read();

        // Переносим таблицу порциями
        $count = count( $return );

        $connection = $model->getDbConnection();
        $transaction=$connection->beginTransaction();

        try
        {

            for ( $offset = $this->ignored; $offset < $count; $offset = $offset + $this->per_limit )
            {

                if ( $offset >= $this->limit )
                {
                    break;
                }

                // Порция
                $spreed = array_slice( $return, $offset, $this->per_limit );

                // Заносим во все таблицы
                foreach ( $this->table_to as $handler => $table )
                {

                    // Show SQL Logger
                    if ( $table == $this->show_table )
                    {
                        var_dump( $this->source_tables[$table] );
                        echo "<hr><strong>Table::</strong> " . $table . "<hr>";
                    }

                    // Получаем SQL запрос
                    $insert = $this->$handler( $table, $spreed );

                    // Выполнение запроса
                    if ( !$this->testMode ) $this->commandSQL( $insert, $connection );

                }

                // Next Max Element
                $this->setMaxId( $model );
                //$this->maxId += $this->per_limit;
            }
            $transaction->commit();

        }
        catch(Exception $e)
        {
            echo "Transaction Error!<br>";
            $transaction->rollback();
        }

        return;

	}

    public function commandSQL( $insert, $connection )
    {
        $command = $connection->createCommand( $insert );
        $command->execute();
    }

    public function setMaxId( $model )
    {
        $criteria    = (new \DBCriteria());
        $criteria->select    = 'max(idplaces) as maxId';
        $this->maxId = $model->find( $criteria )->maxId;
        return;
    }

    // Main Table Function
    public function sqlPlaces( $table, $spreed )
    {
        $ins_val = " name, lat, lng ";
        $insert = 'INSERT INTO '.$table.'
                                    ( '.$ins_val.' )
                                VALUES ';

        $counter = 0;
        $insert_s = [];

        foreach ( $spreed as $v )
        {
            $is_empty = $this->isEmpty( $v );
            $coors = explode(",", $v['J']);

            if ( !$is_empty )
                $insert_s[] = "('".$v['E']."', '".$coors[0]."', '".$coors[1]."')";

            $counter++;
        }

        if ( $insert_s )
            $insert .= implode(",", $insert_s);

        // Show SQL
        if ( $table == $this->show_table )
        {
            echo $insert."==<br>";
        }

        return $insert;
    }

    // Related Table Function
    public function sqlAttrVarchar( $table, $spreed )
    {
        $source = $this->source_tables[$table];
        $ins_val = " idplaces, idattributes, value ";

        $insert = 'INSERT INTO '.$table.'
                                    ( '.$ins_val.' )
                                VALUES ';

        $counter = $this->maxId + 1;

        foreach ( $spreed as $v )
        {
            $is_empty = $this->isEmpty( $v );

            if ( !$is_empty ) {
                $insert_s[] = "(" . $counter . ", '" . $source['K'] . "', '" . $v['K'] . "')";
                $insert_s[] = "(" . $counter . ", '" . $source['L'] . "', '" . $v['L'] . "')";
            }

            $counter++;
        }

        if ( $insert_s )
            $insert .= implode(",", $insert_s);

        // Show SQL
        if ( $table == $this->show_table )
        {
            echo $insert."==<br>";
        }

        return $insert;
    }

    // Related Table Function
    public function sqlAttrInt( $table, $spreed )
    {
        $source = $this->source_tables[$table];
        $ins_val = " idplaces, idattributes, value ";

        $insert = 'INSERT INTO '.$table.'
                                    ( '.$ins_val.' )
                                VALUES ';

        $counter = $this->maxId + 1;
        foreach ( $spreed as $v )
        {
            $is_empty = $this->isEmpty( $v );

            if ( !$is_empty ) {
                $insert_s[] = "(" . $counter . ", '" . $source['M'] . "', '" . $v['M'] . "')";
                $insert_s[] = "(" . $counter . ", '" . $source['N'] . "', '" . $v['N'] . "')";
            }

            $counter++;
        }

        if ( $insert_s )
            $insert .= implode(",", $insert_s);

        // Show SQL
        if ( $table == $this->show_table )
        {
            echo $insert."==<br>";
        }

        return $insert;
    }

    // Related Table Function
    public function sqlService( $table, $spreed )
    {
        $source = $this->source_tables[$table];
        $ins_val = " idservice_type, idplaces ";

        $insert = 'INSERT INTO '.$table.'
                                    ( '.$ins_val.' )
                                VALUES ';

        $counter = $this->maxId + 1;
        foreach ( $spreed as $v )
        {
            $is_empty = $this->isEmpty( $v );

            // Все в Аэропорта
            if ( !$is_empty )
                $insert_s[] = "(2, ".$counter.")";

            $counter++;
        }

        if ( $insert_s )
            $insert .= implode(",", $insert_s);

        // Show SQL
        if ( $table == $this->show_table )
        {
            echo $insert."==<br>";
        }

        return $insert;
    }

    // Related Table Function
    public function sqlRelated( $table, $spreed )
    {
        $source = $this->source_tables[$table];
        $ins_val = implode(",", array_values( $source ));

        $insert = 'INSERT INTO '.$table.'
                                    ( '.$ins_val.' )
                                VALUES ';

        $counter = $this->maxId + 1;
        $insert_s = [];

        foreach ( $spreed as $v )
        {

            $ins_sql = '';
            $is_empty = $this->isEmpty( $v );
            if ( $table == $this->show_table && $this->testMode )
            {
                $ins_sql = "<br>";
            }

            if ( !$is_empty )
                $insert_s[]= $this->insertTable( $v, $table, $counter ).$ins_sql;

            $counter++;
        }

        if ( $insert_s )
            $insert .= implode(",", $insert_s);

        return $insert;
    }

    public function isEmpty( $dataReader )
    {
        $empty = true;
        foreach ( $dataReader as $key => $v)
        {
            if ( in_array($key, $this->empty_ckeck) && !empty($v) )
                $empty = false;
        }

        return $empty;
    }

    // Проверка данных для связанных таблиц
    public function insertTable( $dataReader, $table, $foreign_key )
    {

        $insert = '';
        $insert_s = [];
        $to_sql = [];

        $source_keys = array_keys($this->source_tables[$table]);
        $is_empty = $this->isEmpty( $dataReader );

        if ( !$is_empty )
        {
            foreach ( $this->source_tables[$table] as $column => $value )
            {
                // Все нужные колонки
                if (array_key_exists($column, $dataReader)) {

                    // TODO Filter Data
                    $filtered = addslashes($dataReader[$column]);
                    $filtered = str_replace(',', '.', $filtered);
                    $to_sql[$column] = "'" . $filtered . "'";

                } else {

                    $this->extends[$table]['parent1'] = $foreign_key;
                    $to_sql[$column] = $this->extendsFields($table, $column);

                }

            }
        }

        if ( $to_sql )
        {
            $to_sql = implode(",", $to_sql);
            $insert_s = '('.$to_sql.')';

            // Show SQL
            if ( $table == $this->show_table )
            {
                echo $insert_s."==<br>";
            }
        }

        return $insert_s;

    }

    // Дополнительные поля
    public function extendsFields( $table, $column )
    {

        $params = $this->extends[$table];
        $extends = "''";

        if ( array_key_exists( $column, $params) )
        {
            $extends = "'".$params[$column]."'";
        }

        return $extends;
    }

}