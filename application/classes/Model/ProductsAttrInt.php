<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "products_attr_int".
 *
 * The followings are the available columns in table 'products_attr_int':
 * @property integer $idproducts_attr
 * @property integer $idproducts
 * @property integer $idattributes
 *
 * The followings are the available model relations:
 * @property Products $idproducts0
 * @property Attributes $idattributes0
 */
class ProductsAttrInt extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products_attr_int';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idproducts, idattributes', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idproducts_attr, idproducts, idattributes', 'safe', 'on'=>'search'),
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
			'idproducts0' => array(self::BELONGS_TO, 'Products', 'idproducts'),
			'idattributes0' => array(self::BELONGS_TO, 'Attributes', 'idattributes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idproducts_attr' => 'Idproducts Attr',
			'idproducts' => 'Idproducts',
			'idattributes' => 'Idattributes',
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

		$criteria->compare('idproducts_attr',$this->idproducts_attr);
		$criteria->compare('idproducts',$this->idproducts);
		$criteria->compare('idattributes',$this->idattributes);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return ProductsAttrInt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
