<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "company_attached".
 *
 * The followings are the available columns in table 'company_attached':
 * @property integer $idcompany_attached
 * @property integer $idtransport_company
 * @property integer $idcompany_type
 *
 * The followings are the available model relations:
 * @property TransportCompany $idtransportCompany
 * @property CompanyType $idcompanyType
 */
class CompanyAttached extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company_attached';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idtransport_company, idcompany_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcompany_attached, idtransport_company, idcompany_type', 'safe', 'on'=>'search'),
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
			'idcompanyType' => array(self::BELONGS_TO, 'CompanyType', 'idcompany_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcompany_attached' => 'Idcompany Attached',
			'idtransport_company' => 'Idtransport Company',
			'idcompany_type' => 'Idcompany Type',
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

		$criteria->compare('idcompany_attached',$this->idcompany_attached);
		$criteria->compare('idtransport_company',$this->idtransport_company);
		$criteria->compare('idcompany_type',$this->idcompany_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return CompanyAttached the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
