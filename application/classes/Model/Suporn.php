<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "suporn".
 *
 * The followings are the available columns in table 'suporn':
 * @property integer $idsuporn
 * @property string $name
 * @property string $contact_detail
 * @property string $email
 * @property string $country_code
 * @property string $region_code
 * @property string $city_code
 *
 * The followings are the available model relations:
 * @property SupornCtype[] $supornCtypes
 */
class Suporn extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'suporn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>300),
			array('contact_detail', 'length', 'max'=>500),
			array('email', 'length', 'max'=>20),
			array('country_code, region_code, city_code', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsuporn, name, contact_detail, email, country_code, region_code, city_code', 'safe', 'on'=>'search'),
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
			'supornCtypes' => array(self::HAS_MANY, 'SupornCtype', 'idsuporn'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsuporn' => 'Idsuporn',
			'name' => 'Name',
			'contact_detail' => 'Contact Detail',
			'email' => 'Email',
			'country_code' => 'Country Code',
			'region_code' => 'Region Code',
			'city_code' => 'City Code',
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

		$criteria->compare('idsuporn',$this->idsuporn);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('contact_detail',$this->contact_detail,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('region_code',$this->region_code,true);
		$criteria->compare('city_code',$this->city_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return Suporn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
