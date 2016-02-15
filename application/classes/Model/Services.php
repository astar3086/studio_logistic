<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "services".
 *
 * The followings are the available columns in table 'services':
 * @property integer $idservice_type
 * @property integer $parent_id
 * @property string $name
 * @property string $picture
 *
 * The followings are the available model relations:
 * @property PlaceService[] $placeServices
 */
class Services extends Record
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name, picture', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idservice_type, parent_id, name, picture, view', 'safe', 'on'=>'search'),
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
			'placeServices' => array(self::HAS_MANY, 'PlaceService', 'idservice_type'),
			'serviceChilds' => array(self::HAS_MANY, 'Services', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idservice_type' => 'Idservice Type',
			'parent_id' => 'Parent',
			'name' => 'Name',
			'picture' => 'Picture',
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

		$criteria->compare('idservice_type',$this->idservice_type);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('view',$this->view,true);
		$criteria->compare('picture',$this->picture,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return self[] array id => location's name
	 */
	public function getListArray( $parent_id )
	{

		$result = self::getList('name', " parent_id=:pid AND view =1 ", [":pid"=>$parent_id]);
		return $result;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your Record descendants!
	 * @param string $className active record class name.
	 * @return Services the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
