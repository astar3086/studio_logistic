<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "places_info".
 *
 * The followings are the available columns in table 'places_info':
 * @property integer $idplaces_info
 * @property integer $idplaces
 * @property string $place_type
 * @property string $place_size
 * @property string $max_draft
 * @property string $connection
 * @property string $phone
 * @property string $fax
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Places $idplaces0
 */
class PlacesInfo extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'places_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idplaces', 'numerical', 'integerOnly'=>true),
			array('place_type, place_size, connection', 'length', 'max'=>45),
			array('max_draft', 'length', 'max'=>6),
			array('phone', 'length', 'max'=>12),
			array('fax, email', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idplaces_info, idplaces, place_type, place_size, max_draft, connection, phone, fax, email', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idplaces0' => array(self::BELONGS_TO, 'Places', 'idplaces'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idplaces_info' => 'Idplaces Info',
			'idplaces' => 'Idplaces',
			'place_type' => 'Place Type',
			'place_size' => 'Place Size',
			'max_draft' => 'Max Draft',
			'connection' => 'Connection',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'email' => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idplaces_info',$this->idplaces_info);
		$criteria->compare('idplaces',$this->idplaces);
		$criteria->compare('place_type',$this->place_type,true);
		$criteria->compare('place_size',$this->place_size,true);
		$criteria->compare('max_draft',$this->max_draft,true);
		$criteria->compare('connection',$this->connection,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return PlacesInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
