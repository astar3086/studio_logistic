<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "attributes".
 *
 * The followings are the available columns in table 'attributes':
 * @property integer $idattributes
 * @property string $name
 * @property string $attr_type
 *
 * The followings are the available model relations:
 * @property PlacesAttrDecimal[] $placesAttrDecimals
 * @property PlacesAttrInt[] $placesAttrInts
 * @property PlacesAttrVarchar[] $placesAttrVarchars
 * @property ProductsAttrDecimal[] $productsAttrDecimals
 * @property ProductsAttrInt[] $productsAttrInts
 * @property ProductsAttrVarchar[] $productsAttrVarchars
 */
class Attributes extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attributes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>500),
			array('attr_type', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idattributes, name, attr_type', 'safe', 'on'=>'search'),
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
			'placesAttrDecimals' => array(self::HAS_MANY, 'PlacesAttrDecimal', 'idattributes'),
			'placesAttrInts' => array(self::HAS_MANY, 'PlacesAttrInt', 'idattributes'),
			'placesAttrVarchars' => array(self::HAS_MANY, 'PlacesAttrVarchar', 'idattributes'),
			'productsAttrDecimals' => array(self::HAS_MANY, 'ProductsAttrDecimal', 'idattributes'),
			'productsAttrInts' => array(self::HAS_MANY, 'ProductsAttrInt', 'idattributes'),
			'productsAttrVarchars' => array(self::HAS_MANY, 'ProductsAttrVarchar', 'idattributes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idattributes' => 'Idattributes',
			'name' => 'Name',
			'attr_type' => 'Attr Type',
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

		$criteria->compare('idattributes',$this->idattributes);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('attr_type',$this->attr_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return Attributes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
