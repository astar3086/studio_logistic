<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "transport_company".
 *
 * The followings are the available columns in table 'transport_company':
 * @property integer $idtransport_company
 * @property string $name
 * @property string $expeditors
 * @property string $email
 * @property string $contact_detail
 * @property string $country_code
 * @property string $region_code
 * @property string $city_code
 *
 * The followings are the available model relations:
 * @property CompanyAttached[] $companyAttacheds
 * @property CompanyPlaces[] $companyPlaces
 */
class TransportCompany extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transport_company';
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
			array('expeditors, country_code, region_code, city_code', 'length', 'max'=>45),
			array('email', 'length', 'max'=>20),
			array('contact_detail', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtransport_company, name, expeditors, email, contact_detail, country_code, region_code, city_code', 'safe', 'on'=>'search'),
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
			'companyAttacheds' => array(self::HAS_MANY, 'CompanyAttached', 'idtransport_company'),
			'companyPlaces' => array(self::HAS_MANY, 'CompanyPlaces', 'idtransport_company'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtransport_company' => 'Idtransport Company',
			'name' => 'Name',
			'expeditors' => 'Expeditors',
			'email' => 'Email',
			'contact_detail' => 'Contact Detail',
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

		$criteria->compare('idtransport_company',$this->idtransport_company);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('expeditors',$this->expeditors,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact_detail',$this->contact_detail,true);
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
	 * @return TransportCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
