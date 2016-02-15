<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "places".
 *
 * The followings are the available columns in table 'places':
 * @property integer $idplaces
 * @property string $name
 * @property double $lat
 * @property double $lng
 *
 * The followings are the available model relations:
 * @property CompanyPlaces[] $companyPlaces
 * @property PlaceService $placeService
 * @property PlacesAttrDecimal[] $placesAttrDecimals
 * @property PlacesAttrInt[] $placesAttrInts
 * @property PlacesAttrVarchar[] $placesAttrVarchars
 * @property PlacesInfo[] $placesInfos
 */
class Places extends Record
{

	public $maxId;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'places';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lat, lng', 'numerical'),
			array('name', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idplaces, name, lat, lng', 'safe', 'on'=>'search'),
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
			'companyPlaces' => array(self::HAS_MANY, 'CompanyPlaces', 'idplaces'),
			'placeService' => array(self::HAS_ONE, 'PlaceService', 'idplace_service'),
			'placesAttrDecimals' => array(self::HAS_MANY, 'PlacesAttrDecimal', 'idplaces'),
			'placesAttrInts' => array(self::HAS_MANY, 'PlacesAttrInt', 'idplaces'),
			'placesAttrVarchars' => array(self::HAS_MANY, 'PlacesAttrVarchar', 'idplaces'),
			'placesInfos' => array(self::HAS_MANY, 'PlacesInfo', 'idplaces'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idplaces' => 'Idplaces',
			'name' => 'Name',
			'lat' => 'Lat',
			'lng' => 'Lng',
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

		$criteria->compare('idplaces',$this->idplaces);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return Places the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
