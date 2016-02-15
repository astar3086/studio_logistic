<?php

namespace Model;

use \Database\ActiveRecord\Record;

/**
 * This is the model class for table "places3".
 *
 * The followings are the available columns in table 'places3':
 * @property integer $id
 * @property string $title
 * @property string $port_authority
 * @property string $connection
 * @property string $type
 * @property string $type_of_port
 * @property string $country
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $web
 * @property string $lat
 * @property string $lng
 * @property string $code
 * @property string $port_type
 * @property string $port_size
 * @property string $max_draft
 * @property string $icon
 */
class Places3 extends Record
{

	public $count_id;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'places3';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, port_authority, connection, type, type_of_port, country, phone, fax, email, web, lat, lng, code, port_type, port_size, max_draft, icon', 'required'),
			array('title, port_authority, connection, type, type_of_port, country, phone, fax, email, web, lat, lng, code, port_type, port_size, max_draft, icon', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, port_authority, connection, type, type_of_port, country, phone, fax, email, web, lat, lng, code, port_type, port_size, max_draft, icon', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'port_authority' => 'Port Authority',
			'connection' => 'Connection',
			'type' => 'Type',
			'type_of_port' => 'Type Of Port',
			'country' => 'Country',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'email' => 'Email',
			'web' => 'Web',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'code' => 'Code',
			'port_type' => 'Port Type',
			'port_size' => 'Port Size',
			'max_draft' => 'Max Draft',
			'icon' => 'Icon',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('port_authority',$this->port_authority,true);
		$criteria->compare('connection',$this->connection,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('type_of_port',$this->type_of_port,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('port_type',$this->port_type,true);
		$criteria->compare('port_size',$this->port_size,true);
		$criteria->compare('max_draft',$this->max_draft,true);
		$criteria->compare('icon',$this->icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Places3 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
