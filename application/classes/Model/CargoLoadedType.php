<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "cargo_loaded_type".
 *
 * The followings are the available columns in table 'cargo_loaded_type':
 * @property integer $idcargo_loaded_type
 * @property string $name
 *
 * The followings are the available model relations:
 * @property CargoInfo[] $cargoInfos
 */
class CargoLoadedType extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cargo_loaded_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcargo_loaded_type, name', 'safe', 'on'=>'search'),
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
			'cargoInfos' => array(self::HAS_MANY, 'CargoInfo', 'idcargo_loaded_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcargo_loaded_type' => 'Idcargo Loaded Type',
			'name' => 'Name',
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

		$criteria->compare('idcargo_loaded_type',$this->idcargo_loaded_type);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return CargoLoadedType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
