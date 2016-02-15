<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "suporn_ctype".
 *
 * The followings are the available columns in table 'suporn_ctype':
 * @property integer $idsuporn_ctype
 * @property integer $idcompany_type
 * @property integer $idsuporn
 *
 * The followings are the available model relations:
 * @property Suporn $idsuporn0
 * @property CompanyType $idcompanyType
 */
class SupornCtype extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'suporn_ctype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcompany_type, idsuporn', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsuporn_ctype, idcompany_type, idsuporn', 'safe', 'on'=>'search'),
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
			'idsuporn0' => array(self::BELONGS_TO, 'Suporn', 'idsuporn'),
			'idcompanyType' => array(self::BELONGS_TO, 'CompanyType', 'idcompany_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsuporn_ctype' => 'Idsuporn Ctype',
			'idcompany_type' => 'Idcompany Type',
			'idsuporn' => 'Idsuporn',
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

		$criteria->compare('idsuporn_ctype',$this->idsuporn_ctype);
		$criteria->compare('idcompany_type',$this->idcompany_type);
		$criteria->compare('idsuporn',$this->idsuporn);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return SupornCtype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
