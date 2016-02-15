<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "brokers_ctype".
 *
 * The followings are the available columns in table 'brokers_ctype':
 * @property integer $idbrokers_ctype
 * @property integer $idcompany_type
 * @property integer $idbrokers
 *
 * The followings are the available model relations:
 * @property Brokers $idbrokers0
 * @property CompanyType $idcompanyType
 */
class BrokersCtype extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'brokers_ctype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcompany_type, idbrokers', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idbrokers_ctype, idcompany_type, idbrokers', 'safe', 'on'=>'search'),
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
			'idbrokers0' => array(self::BELONGS_TO, 'Brokers', 'idbrokers'),
			'idcompanyType' => array(self::BELONGS_TO, 'CompanyType', 'idcompany_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idbrokers_ctype' => 'Idbrokers Ctype',
			'idcompany_type' => 'Idcompany Type',
			'idbrokers' => 'Idbrokers',
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

		$criteria->compare('idbrokers_ctype',$this->idbrokers_ctype);
		$criteria->compare('idcompany_type',$this->idcompany_type);
		$criteria->compare('idbrokers',$this->idbrokers);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return BrokersCtype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
