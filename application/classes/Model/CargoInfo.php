<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "cargo_info".
 *
 * The followings are the available columns in table 'cargo_info':
 * @property integer $idcargo_info
 * @property string $name
 * @property integer $weight
 * @property integer $quantity
 * @property integer $load_volume
 * @property integer $idcargo_loaded_type
 * @property integer $idcargo_packing
 * @property integer $idcargo_transport
 *
 * The followings are the available model relations:
 * @property CargoLoadedType $idcargoLoadedType
 * @property CargoPacking $idcargoPacking
 * @property CargoTransport $idcargoTransport
 */
class CargoInfo extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cargo_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('weight, quantity, load_volume, idcargo_loaded_type, idcargo_packing, idcargo_transport', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcargo_info, name, weight, quantity, load_volume, idcargo_loaded_type, idcargo_packing, idcargo_transport', 'safe', 'on'=>'search'),
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
			'idcargoLoadedType' => array(self::BELONGS_TO, 'CargoLoadedType', 'idcargo_loaded_type'),
			'idcargoPacking' => array(self::BELONGS_TO, 'CargoPacking', 'idcargo_packing'),
			'idcargoTransport' => array(self::BELONGS_TO, 'CargoTransport', 'idcargo_transport'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcargo_info' => 'Idcargo Info',
			'name' => 'Name',
			'weight' => 'Weight',
			'quantity' => 'Quantity',
			'load_volume' => 'Load Volume',
			'idcargo_loaded_type' => 'Idcargo Loaded Type',
			'idcargo_packing' => 'Idcargo Packing',
			'idcargo_transport' => 'Idcargo Transport',
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

		$criteria->compare('idcargo_info',$this->idcargo_info);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('load_volume',$this->load_volume);
		$criteria->compare('idcargo_loaded_type',$this->idcargo_loaded_type);
		$criteria->compare('idcargo_packing',$this->idcargo_packing);
		$criteria->compare('idcargo_transport',$this->idcargo_transport);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return CargoInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
