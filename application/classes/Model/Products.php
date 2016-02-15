<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $idproducts
 * @property integer $idmanufactures
 *
 * The followings are the available model relations:
 * @property Manufacturers $idmanufactures0
 * @property ProductsAttrDecimal[] $productsAttrDecimals
 * @property ProductsAttrInt[] $productsAttrInts
 * @property ProductsAttrVarchar[] $productsAttrVarchars
 */
class Products extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idmanufactures', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idproducts, idmanufactures', 'safe', 'on'=>'search'),
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
			'idmanufactures0' => array(self::BELONGS_TO, 'Manufacturers', 'idmanufactures'),
			'productsAttrDecimals' => array(self::HAS_MANY, 'ProductsAttrDecimal', 'idproducts'),
			'productsAttrInts' => array(self::HAS_MANY, 'ProductsAttrInt', 'idproducts'),
			'productsAttrVarchars' => array(self::HAS_MANY, 'ProductsAttrVarchar', 'idproducts'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idproducts' => 'Idproducts',
			'idmanufactures' => 'Idmanufactures',
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

		$criteria->compare('idproducts',$this->idproducts);
		$criteria->compare('idmanufactures',$this->idmanufactures);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
