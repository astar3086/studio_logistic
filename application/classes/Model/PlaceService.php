<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "place_service".
 *
 * The followings are the available columns in table 'place_service':
 * @property integer $idplace_service
 * @property integer $idservice_type
 * @property integer $idplaces
 *
 * The followings are the available model relations:
 * @property Places $idplaceService
 * @property Services $idserviceType
 */
class PlaceService extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'place_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idservice_type, idplaces', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idplace_service, idservice_type, idplaces', 'safe', 'on'=>'search'),
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
			'idplaceService' => array(self::BELONGS_TO, 'Places', 'idplace_service'),
			'idserviceType' => array(self::BELONGS_TO, 'Services', 'idservice_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idplace_service' => 'Idplace Service',
			'idservice_type' => 'Idservice Type',
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

		$criteria->compare('idplace_service',$this->idplace_service);
		$criteria->compare('idservice_type',$this->idservice_type);
		$criteria->compare('idplaces',$this->idplaces);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return PlaceService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
