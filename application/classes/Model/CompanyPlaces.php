<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "company_places".
 *
 * The followings are the available columns in table 'company_places':
 * @property integer $idcompany_places
 * @property integer $idtransport_company
 * @property integer $idplaces
 *
 * The followings are the available model relations:
 * @property TransportCompany $idtransportCompany
 * @property Places $idplaces0
 */
class CompanyPlaces extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company_places';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idtransport_company, idplaces', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcompany_places, idtransport_company, idplaces', 'safe', 'on'=>'search'),
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
			'idtransportCompany' => array(self::BELONGS_TO, 'TransportCompany', 'idtransport_company'),
			'idplaces0' => array(self::BELONGS_TO, 'Places', 'idplaces'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcompany_places' => 'Idcompany Places',
			'idtransport_company' => 'Idtransport Company',
			'idplaces' => 'Idplaces',
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

		$criteria->compare('idcompany_places',$this->idcompany_places);
		$criteria->compare('idtransport_company',$this->idtransport_company);
		$criteria->compare('idplaces',$this->idplaces);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return CompanyPlaces the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
